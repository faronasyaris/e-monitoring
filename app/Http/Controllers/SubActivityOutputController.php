<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PlottingProgram;
use App\Models\SubActivityOutput;
use App\Models\SubActivityOutputHistory;
use App\Models\PlottingSubActivityOutput;

class SubActivityOutputController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'unit' => 'required',
            'target' => 'required',
            'id' => 'required',
        ]);

        $outcome = SubActivityOutput::create([
            'activity_output_name' => $request->description,
            'sub_activity_id' => $request->id,
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingSubActivityOutput::create([
                    'unit' => $request->unit,
                    'target' => $request->target,
                    'achievment' => 0,
                    'outcome_id' => $outcome->id,
                    'month' => $i
                ]);
            }
        }

        toast('Sub Activity Outcome Berhasil Dibuat', "success");
        return back();
    }

    public function addAchievment(PlottingSubActivityOutput $id, Request $request)
    {
        $request->validate([
            'achievment' => 'required'
        ]);
        $new_achievment = $id->achievment + $request->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingSubActivityOutput::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
                $outcome_plot->update([
                    'achievment' => $new_achievment,
                ]);
            }
        }

        $id->load('getOutputSubActivity', 'getOutputSubActivity.getSubActivity');

        $filename = null;
        if ($request->hasFile('evidence')) {
            $file = $request->evidence;
            $dest = 'evidence';
            $filename = Str::random(6) . date('YmdHis') . $file->getClientOriginalExtension();
            $file->move($dest, $filename);
        }
        SubActivityOutputHistory::create([
            'date' => date('Y-m-d'),
            'sub_activity_id' => $id->getOutputSubActivity->getSubActivity->id,
            'outcome_id' => $id->outcome_id,
            'achievment' => $request->achievment,
            'file' => $filename,
            'user_id' => auth()->user()->id
        ]);

        toast('Capaian Berhasil Ditambahkan', 'success');
        return back();
    }

    public function cancelAchievment(SubActivityOutputHistory $id, Request $request)
    {
        $id->load('getOutputActivity', 'getOutputActivity.getPlotting');
        $new_achievment = $id->getOutputActivity->getPlotting->where('month', session('month'))->first()->achievment - $id->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingSubActivityOutput::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
                $outcome_plot->update([
                    'achievment' => $new_achievment,
                ]);
            }
        }

        $id->delete();

        toast('Capaian Berhasil Dibatalkan', 'success');
        return back();
    }

    public function update(Request $request, SubActivityOutput $id)
    {
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingSubActivityOutput::where('month', $i)->where('outcome_id', $id->id)->first();
                if (!empty($outcome_plot)) {
                    $outcome_plot->update([
                        'unit' => $request->unit,
                        'target' => $request->target,
                    ]);
                }
            }
        }

        $id->update([
            'activity_output_name' => $request->outcome_name
        ]);

        toast('Output Sub Kegiatan berhasil diupdate', 'success');
        return back();
    }

    public function delete(SubActivityOutput $id)
    {
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingSubActivityOutput::where('month', $i)->where('outcome_id', $id->id)->first();
                if (!empty($outcome_plot)) {
                    $outcome_plot->delete();
                }
            }
        }

        toast('Output Sub Kegiatan berhasil dihapus', 'success');
        return back();
    }

    public function updateBudget()
    {
    }

    public function addFinanceRealization()
    {
    }

    public function cancelFinanceRealization()
    {
    }
}
