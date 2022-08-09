<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Models\SubActivity;
use Illuminate\Http\Request;
use App\Models\SubActivityOutput;
use App\Models\SubActivityWorker;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){
        $request->validate([
            'activity_id'=>'required',
            'name'=>'required',
            'unit'=>'required',
            'target'=>'required',
            'indicator'=>'required',
            'output'=>'required',
            'pelaksana'=>'required'
        ]);

        $subActivity = SubActivity::create([
            'name'=>$request->name,
            'indicator'=>$request->indicator,
            'unit_target'=>$request->unit,
            'target'=>$request->target,
            'activity_id'=>$request->activity_id,
            'status'=>"On Progress",
        ]);

        foreach($request->output as $output){
            SubActivityOutput::create([
                'description'=>$output,
                'sub_activity_id'=>$subActivity->id
            ]);
        }

        foreach($request->pelaksana as $pelaksana){
            SubActivityWorker::create([
                'sub_activity_id'=>$subActivity->id,
                'worker_id'=> $pelaksana,
            ]);
        }

        toast('Sub Activity berhasil dibuat','success');
        return redirect("/kegiatan/$request->activity_id/manage-kegiatan");
    }

    public function approval(){
        return view('headOfDivision.approval.index');
    }

    public function detailSubActivity($id){
        if(Auth::User()->role == 'Kepala Bidang'){
            $sub = SubActivity::with('getSubActivityOutput','getSubActivitySubmission','getSubActivityWorker')->where('id',$id)->first();
            return view('headOfDivision.sub-activity.detail',compact('sub'));
        }
        else if(Auth::User()->role == 'Employee'){
            $sub = SubActivity::with('getSubActivityOutput','getSubActivitySubmission','getSubActivityWorker')->where('id',$id)->first();
            return view('employee.detailSubKegiatan',compact('sub'));
        }
  
    }

    public function getSubActivityByWorker(){
        $subActivities = SubActivityWorker::with('getActivity')->where('worker_id',auth()->user()->id)->get();
        return view('employee.subKegiatan',compact('subActivities'));
    }

    public function submitProgress(Request $request){
        $request->validate([
            'id'=>'required',
            'title'=>'required',
            'file'=>'required'
        ]);
    }
}
