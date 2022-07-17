<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class FieldController extends Controller
{
    public function checkField($id){
        $check = User::where('field_id',$id)->where('role','Kepala Bidang')->first();
        
        return response(['data'=>$check]);
    }
}
