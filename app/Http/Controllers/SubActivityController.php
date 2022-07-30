<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

class SubActivityController extends Controller
{
    public function index(){
        if(auth()->user()->role =='Kepala Dinas'){
            return view('headOfDepartement.sub-activity.index');
        }

        else if(auth()->user()->role =='Kepala Bidang'){
            return view('headOfDivision.sub-activity.index');
        }
    }

    public function create($id){
        $workers = User::where('field_id',auth()->user()->field_id)->where('id','!=',auth()->user()->id)->get();
        $activity = Activity::findOrFail($id);
        return view('headOfDivision.sub-activity.create',compact('activity','workers'));
    }

    public function store(){
        
    }

    public function approval(){
        return view('headOfDivision.approval.index');
    }

    public function detailSubActivity($id){

    }
}
