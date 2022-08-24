<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Activity;
use App\Models\SubActivity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubActivityOutput;
use App\Models\SubActivityWorker;
use Illuminate\Support\Facades\Auth;
use App\Models\SubActivitySubmission;

class SubActivityController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Kepala Dinas') {
            return view('headOfDepartement.sub-activity.index');
        } else if (auth()->user()->role == 'Kepala Bidang') {
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->whereIn('program_id', $programs->pluck('id'))->get();
            $sub_activities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->whereIn('activity_id', $activities->pluck('id'))->get();
            return view('headOfDivision.sub-activity.index', compact('programs', 'activities', 'sub_activities'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'name' => 'required',
            'unit' => 'required',
            'target' => 'required',
            'indicator' => 'required',
            'output' => 'required',
            'pelaksana' => 'required'
        ]);

        $subActivity = SubActivity::create([
            'name' => $request->name,
            'indicator' => $request->indicator,
            'unit_target' => $request->unit,
            'target' => $request->target,
            'activity_id' => $request->activity_id,
            'status' => "On Progress",
        ]);


        toast('Sub Activity berhasil dibuat', 'success');
        return redirect("/kegiatan/$request->activity_id/manage-kegiatan");
    }

    public function detail()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

    public function export()
    {
    }

    // public function approval(){
    //     return view('headOfDivision.approval.index');
    // }

    // public function detailSubActivity($id){
    //     if(Auth::User()->role == 'Kepala Bidang'){
    //         $sub = SubActivity::with('getSubActivityOutput','getSubActivitySubmission','getSubActivityWorker')->where('id',$id)->first();
    //         return view('headOfDivision.sub-activity.detail',compact('sub'));
    //     }
    //     else if(Auth::User()->role == 'Employee'){
    //         $sub = SubActivity::with('getSubActivityOutput','getSubActivitySubmission','getSubActivityWorker','getSubActivitySubmission','getSubActivitySubmission.getWorker')->where('id',$id)->first();
    //         return view('employee.detailSubKegiatan',compact('sub'));
    //     }

    // }

    // public function getSubActivityByWorker(){
    //     $subActivities = SubActivityWorker::with('getActivity')->where('worker_id',auth()->user()->id)->get();
    //     return view('employee.subKegiatan',compact('subActivities'));
    // }

    // public function submitProgress(Request $request){
    //     $request->validate([
    //         'id'=>'required',
    //         'title'=>'required',
    //         'file'=>'required'
    //     ]);

    //     $filename = '';
    //     if($request->hasFile('file')){
    //         $file = $request->file;
    //         $dest = 'submission_file';
    //         $filename = Str::slug($request->title).'-'.date('YmdHis'). "." . $file->getClientOriginalExtension();
    //         $file->move($dest, $filename);
    //     }

    //     SubActivitySubmission::create([
    //         'title'=>$request->title,
    //         'worker_id'=>auth()->user()->id,
    //         'sub_activity_id'=>$request->id,
    //         'submission_file' => $filename,
    //     ]);

    //     return back()->with('success','data berhasil di submit');
    // }
}
