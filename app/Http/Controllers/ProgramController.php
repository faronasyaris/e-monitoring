<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\PlottingProgram;
use App\Models\PlottingProgramOutcome;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Kepala Dinas') {
            $programs = Program::where('year', $this->currentYear())->get();
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
            'year' => $this->currentYear()
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
        $program_plot = PlottingProgram::where('id', $id)->first();
        $program_outcomes = PlottingProgramOutcome::where('plotting_program_id', $program_plot->id)->get();
        return view('headOfDivision.program.detail-program', compact('program_plot', 'program_outcomes'));
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
}
