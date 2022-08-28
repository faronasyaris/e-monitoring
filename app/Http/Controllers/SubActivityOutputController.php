<?php

namespace App\Http\Controllers;

use App\Models\PlottingSubActivityOutput;
use App\Models\SubActivityOutput;
use App\Models\SubActivityOutputHistory;
use Illuminate\Http\Request;

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

    public function cancelAchievment()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
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
