<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(){
        $periods = Periode::orderBy('year','desc')->get();
        return view('secretary.period.index',compact('periods'));
    }

    public function store(Request $request){
        $request->validate([
            'year'=>'required'
        ]);

        $check_periode = Periode::where('year',$request->year)->first();
        if(!empty($check_periode)){
            toast("Data Periode Tahun $request->year sudah tersedia",'error');
            return back();
        }

        Periode::create([
            'year'=>$request->year,
        ]);

        toast('Data Periode berhasil ditambah','success');
        return back();
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request)
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
    }
}
