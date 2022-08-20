<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProgramOutcome;
use App\Models\PlottingProgram;
use App\Models\ProgramOutcomeHistory;
use App\Models\PlottingProgramOutcome;

class ProgramOutcomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'unit' => 'required',
            'target' => 'required',
            'id' => 'required',
        ]);

        $outcome = ProgramOutcome::create([
            'program_outcome_name' => $request->description,
            'program_id' => $request->id,
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingProgramOutcome::create([
                    'unit' => $request->unit,
                    'target' => $request->target,
                    'achievment' => 0,
                    'outcome_id' => $outcome->id,
                    'month' => $i
                ]);
            }
        }

        toast('Program Outcome Berhasil Dibuat', true);
        return back();
    }

    public function addAchievment(PlottingProgramOutcome $id, Request $request)
    {
        $request->validate([
            'achievment' => 'required'
        ]);
        $new_achievment = $id->achievment + $request->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingProgramOutcome::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
                $outcome_plot->update([
                    'achievment' => $new_achievment,
                ]);
            }
        }

        $id->load('getOutcomeProgram', 'getOutcomeProgram.getProgram');

        $filename = null;
        if ($request->hasFile('evidence')) {
            $file = $request->evidence;
            $dest = 'evidence';
            $filename = Str::random(6) . date('YmdHis') . $file->getClientOriginalExtension();
            $file->move($dest, $filename);
        }
        ProgramOutcomeHistory::create([
            'date' => date('Y-m-d'),
            'program_id' => $id->getOutcomeProgram->getProgram->id,
            'outcome_id' => $id->outcome_id,
            'achievment' => $request->achievment,
            'file' => $filename,
            'user_id' => auth()->user()->id
        ]);

        toast('Capaian Berhasil Ditambahkan', 'success');
        return back();
    }

    public function cancelAchievment(ProgramOutcomeHistory $id, Request $request)
    {
        $id->load('getOutcomeProgram', 'getOutcomeProgram.getPlotting');
        $new_achievment = $id->getOutcomeProgram->getPlotting->where('month', session('month'))->first()->achievment - $id->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingProgramOutcome::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
                $outcome_plot->update([
                    'achievment' => $new_achievment,
                ]);
            }
        }

        $id->delete();

        toast('Capaian Berhasil Dibatalkan', 'success');
        return back();
    }
}
