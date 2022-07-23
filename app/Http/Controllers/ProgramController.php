<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(){
        if(auth()->user()->role =='Kepala Dinas'){
            return view('headOfDepartement.program.index');
        }

        else if(auth()->user()->role =='Kepala Bidang'){
            return view('headOfDivision.program.index');
        }
    }
}
