<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlottingProgram;
use App\Models\PlottingProgramOutcome;
use App\Models\ProgramOutcomeHistory;

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

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $program_plot = PlottingProgram::with('getOutcome')->where('month', $i)->where('program_id', $request->id)->first();
                PlottingProgramOutcome::create([
                    'description' => $request->description,
                    'unit' => $request->unit,
                    'target' => $request->target,
                    'achievment' => 0,
                    'plotting_program_id' => $program_plot->id,
                ]);
            }
        }

        toast('Program Outcome Berhasil Dibuat', true);
        return back();
    }

    public function addAchievment(PlottingProgramOutcome $id, Request $request)
    {
        // $request->validate([
        //     'achievment' => 'required'
        // ]);

        // $new_achievment = $id->achievment + $request->achievment;
        // $id->update([
        //     'achievment' => $new_achievment
        // ]);

        // for ($i = 1; $i <= 12; $i++) {
        //     if ($i >= session('month')) {
        //         $outcome_plot = PlottingProgramOutcome::where('month', $i)->where('program_id', $request->id)->first();
        //         PlottingProgramOutcome::create([
        //             'description' => $request->description,
        //             'unit' => $request->unit,
        //             'target' => $request->target,
        //             'achievment' => 0,
        //             'plotting_program_id' => $program_plot->id,
        //         ]);
        //     }
        // }

        // $id->load('getPlottingProgram', 'getPlottingProgram.getProgram');

        // ProgramOutcomeHistory::create([
        //     'date' => date('Y-m-d'),
        //     'program_id' => $id->getPlottingProgram->getProgram->id,
        //     'achievment' => $request->achievment,
        //     'user_id' => auth()->user()->id
        // ]);

        // toast('Capaian Berhasil Ditambahkan', true);
        // return back();
    }
}
