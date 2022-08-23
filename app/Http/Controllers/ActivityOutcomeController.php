<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ActivityOutcome;
use App\Models\ActivityOutcomeHistory;
use App\Models\PlottingActivity;
use App\Models\PlottingActivityOutcome;

class ActivityOutcomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'unit' => 'required',
            'target' => 'required',
            'id' => 'required',
        ]);

        $outcome = ActivityOutcome::create([
            'activity_outcome_name' => $request->description,
            'activity_id' => $request->id,
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingActivityOutcome::create([
                    'unit' => $request->unit,
                    'target' => $request->target,
                    'achievment' => 0,
                    'outcome_id' => $outcome->id,
                    'month' => $i
                ]);
            }
        }

        toast('Outcome Kegiatan Berhasil Dibuat', true);
        return back();
    }

    public function addAchievment(PlottingActivityOutcome $id, Request $request)
    {
        $request->validate([
            'achievment' => 'required'
        ]);
        $new_achievment = $id->achievment + $request->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingActivityOutcome::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
                $outcome_plot->update([
                    'achievment' => $new_achievment,
                ]);
            }
        }

        $id->load('getOutcomeActivity', 'getOutcomeActivity.getActivity');

        $filename = null;
        if ($request->hasFile('evidence')) {
            $file = $request->evidence;
            $dest = 'evidence';
            $filename = Str::random(6) . date('YmdHis') . $file->getClientOriginalExtension();
            $file->move($dest, $filename);
        }
        ActivityOutcomeHistory::create([
            'date' => date('Y-m-d'),
            'activity_id' => $id->getOutcomeActivity->getActivity->id,
            'outcome_id' => $id->outcome_id,
            'achievment' => $request->achievment,
            'file' => $filename,
            'user_id' => auth()->user()->id
        ]);

        toast('Capaian Berhasil Ditambahkan', 'success');
        return back();
    }

    public function cancelAchievment(ActivityOutcomeHistory $id, Request $request)
    {
        $id->load('getOutcomeActivity', 'getOutcomeActivity.getPlotting');
        $new_achievment = $id->getOutcomeActivity->getPlotting->where('month', session('month'))->first()->achievment - $id->achievment;

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $outcome_plot = PlottingActivityOutcome::where('month', $i)->where('outcome_id', $id->outcome_id)->first();
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
