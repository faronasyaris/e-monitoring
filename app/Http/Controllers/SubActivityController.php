<?php

namespace App\Http\Controllers;

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

    public function create(){

    }

    public function store(){
        
    }

    public function approval(){
        return view('headOfDivision.approval.index');
    }

    public function detailSubActivity($id){

    }
}
