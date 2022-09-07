<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Program;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\ActivityOutcome;
use App\Models\PlottingActivity;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityOutcomeHistory;

class ActivityController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Kepala Dinas') {
            $fields = Field::all();
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->whereIn('program_id', $programs->pluck('id'))->get();
            return view('headOfDepartement.activity.index', compact('programs', 'activities', 'fields'));
        } else if (auth()->user()->role == 'Kepala Bidang') {
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->whereIn('program_id', $programs->pluck('id'))->get();
            return view('headOfDivision.activity.index', compact('programs', 'activities'));
        }
    }

    public function create($id)
    {
        $program = Program::find($id);
        return view('headOfDivision.activity.create', compact('program'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
            'program_id' => 'required'
        ]);

        $activity = Activity::create([
            'activity_name' => $request->activity_name,
            'created_id' => Auth::id(),
            'field_id' => auth()->user()->field_id,
            'year' => session('year'),
            'program_id' => $request->program_id,
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingActivity::create([
                    'activity_id' => $activity->id,
                    'month' => $i,
                ]);
            }
        }

        toast("Kegiatan Berhasil ditambahkan", 'success');
        return back();
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::where('id', $id)->first();

        $activity->update([
            'activity_name' => $request->activity_name,
        ]);
        toast('Kegiatan berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $plotting = PlottingActivity::where('activity_id', $id)->where('month', $i)->first();
                if (!empty($plotting)) {
                    $plotting->delete();
                }
            }
        }
        toast('Kegiatan berhasil dihapus', 'success');
        return back();
    }

    public function detailActivity($id)
    {
        $activity = Activity::where('id', $id)->first();
        $activity_outcomes = ActivityOutcome::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('activity_id', $id)->get();
        $histories = ActivityOutcomeHistory::where('activity_id', $activity->id)->whereMonth('date', session('month'))->get();
        return view('headOfDivision.activity.detail', compact('activity', 'activity_outcomes', 'histories'));
    }

    public function getActivityByProgram($id)
    {
        $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('year', session('year'))->where('program_id', $id)->get();

        return response()->json(['data' => $activities]);
    }
}
