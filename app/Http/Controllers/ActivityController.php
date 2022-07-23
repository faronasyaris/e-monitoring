<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Program;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        if(auth()->user()->role =='Kepala Dinas'){
            return view('headOfDepartement.activity.index');
        }

        else if(auth()->user()->role =='Kepala Bidang'){
            $programs = Program::with('getActivity')->where('field_id',auth()->user()->field_id)->get();
            return view('headOfDivision.activity.index',compact('programs'));
        }
    }

    public function create($id){
        $program = Program::find($id);
        return view('headOfDivision.activity.create',compact('program'));
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'unit'=>'required',
            'indicator'=>'required',
            'program_id'=>'required'
        ]);

        Activity::create([
            'name'=>$request->name,
            'activity_unit_target'=>$request->unit,
            'activity_goal_indicator'=>$request->indicator,
            'program_id'=>$request->program_id,
        ]);

        toast("Kegiatan Berhasil ditambahkan",'success');
        return redirect("/program/$request->program_id/manage-program");
    }

    public function edit($id){

    }

    public function update(){

    }

    public function delete(){

    }
}
