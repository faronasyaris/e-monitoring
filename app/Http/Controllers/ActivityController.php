<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){
        if(auth()->user()->role =='Kepala Dinas'){
            return view('headOfDepartement.activity.index');
        }

        else if(auth()->user()->role =='Kepala Bidang'){
            return view('headOfDivision.activity.index');
        }
    }
}
