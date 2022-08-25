<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\PlottingProgram;
use App\Models\PlottingProgramOutcome;
use App\Models\Program;
use App\Models\ProgramOutcome;
use App\Models\ProgramOutcomeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Kepala Dinas') {
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            return view('headOfDepartement.program.index', compact('programs'));
        } else if (auth()->user()->role == 'Kepala Bidang') {
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            return view('headOfDivision.program.index', compact('programs'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required'
        ]);

        $program = Program::create([
            'program_name' => $request->program_name,
            'created_id' => Auth::id(),
            'field_id' => auth()->user()->field_id,
            'year' => session('year')
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingProgram::create([
                    'program_id' => $program->id,
                    'month' => $i,
                ]);
            }
        }

        toast("Program Berhasil ditambahkan", 'success');
        return back();
    }

    public function detailProgram($id)
    {
        $program = Program::where('id', $id)->first();
        $program_outcomes = ProgramOutcome::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('program_id', $id)->get();
        $histories = ProgramOutcomeHistory::where('program_id', $program->id)->whereMonth('date', session('month'))->get();
        return view('headOfDivision.program.detail-program', compact('program', 'program_outcomes', 'histories'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::where('id', $id)->first();

        $program->update([
            'program_name' => $request->program_name,
        ]);
        toast('Program berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        $period = Program::where('id', $id)->first();
        $period->delete();
        toast('Program berhasil dihapus', 'success');
        return redirect('/program');
    }

    public function export()
    {
    }
}
