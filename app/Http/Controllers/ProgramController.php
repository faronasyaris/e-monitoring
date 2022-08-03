<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(){
        if(auth()->user()->role =='Kepala Dinas'){
            $programs = Program::where('year',$this->currentYear())->get();
            return view('headOfDepartement.program.index',compact('programs'));
        }

        else if(auth()->user()->role =='Kepala Bidang'){
            $programs = Program::with('getProgramIndicator','getActivity')->where('field_id',auth()->user()->field_id)->get();
            return view('headOfDivision.program.index',compact('programs'));
        }
    }

    public function store(Request $request){
        $request->validate([
            'program_name'=>'required'
        ]);

        Program::create([
            'program_name'=>$request->program_name,
            'created_id'=>Auth::id(),
            'field_id'=>auth()->user()->field_id,
            'year'=>$this->currentYear()
        ]);

        toast("Program Berhasil ditambahkan",'success');
        return back();
    }

    public function detailProgram($id){
        $program = Program::with('getProgramIndicator','getActivity')->where('id',$id)->first();
        return view('headOfDivision.program.detail-program',compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::where('id', $id)->first();

        $program->update([
            'program_name'=>$request->program_name,
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
