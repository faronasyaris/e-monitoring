<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Activity;
use App\Models\PlottingSubActivity;
use App\Models\SubActivity;
use App\Models\SubActivityBudgetHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubActivityOutput;
use App\Models\SubActivityOutputHistory;
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
            $employees = User::where('field_id', auth()->user()->field_id)->where('role', 'Pelaksana')->get();
            $programs = Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            $activities = Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->whereIn('program_id', $programs->pluck('id'))->get();
            $sub_activities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->whereIn('activity_id', $activities->pluck('id'))->get();
            return view('headOfDivision.sub-activity.index', compact('programs', 'activities', 'sub_activities', 'employees'));
        } else if (auth()->user()->role == 'Pelaksana') {
            $subActivities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'))->where('user_id', auth()->user()->id);
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            return view('employee.subKegiatan', compact('subActivities'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'activity_name' => 'required',
            'budget' => 'required',
            'worker' => 'required',
        ]);

        $subActivity = SubActivity::create([
            'sub_activity_name' => $request->activity_name,
            'year' => session('year'),
            'field_id' => auth()->user()->field_id,
            'activity_id' => $request->activity_id,
            'created_id' => Auth::id(),
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                PlottingSubActivity::create([
                    'sub_activity_id' => $subActivity->id,
                    'month' => $i,
                    'budget' => $request->budget,
                    'user_id' => $request->worker,
                ]);
            }
        }

        toast('Sub Kegiatan berhasil dibuat', 'success');
        return back();
    }

    public function detail($id)
    {
        $employees = User::where('field_id', auth()->user()->field_id)->where('role', 'Pelaksana')->get();
        $subActivity = SubActivity::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('id', $id)->first();
        $plotSubActivity = $subActivity->getPlotting->first();
        $sub_activity_output = SubActivityOutput::withAndWhereHas('getPlotting', function ($query) {
            $query->where('month', session('month'));
        })->where('sub_activity_id', $id)->get();
        $histories = SubActivityOutputHistory::where('sub_activity_id', $subActivity->id)->whereMonth('date', session('month'))->get();
        $budgetHistories = SubActivityBudgetHistory::where('sub_activity_id', $subActivity->id)->whereMonth('date', session('month'))->get();
        return view('headOfDivision.sub-activity.detail', compact('budgetHistories', 'plotSubActivity', 'subActivity', 'sub_activity_output', 'histories', 'employees'));
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

    public function storeFinanceRealization(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'budget' => 'required',
            'id' => 'required'
        ]);

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $plotSubActivity = PlottingSubActivity::where('month', $i)->where('sub_activity_id', $request->id)->first();
                $newFinanceRealization = $plotSubActivity->finance_realization + $request->budget;
                $plotSubActivity->update([
                    'finance_realization' => $newFinanceRealization
                ]);
            }
        }

        $filename = null;
        if ($request->hasFile('evidence')) {
            $file = $request->evidence;
            $dest = 'evidence';
            $filename = Str::random(6) . date('YmdHis') . $file->getClientOriginalExtension();
            $file->move($dest, $filename);
        }

        SubActivityBudgetHistory::create([
            'date' => now(),
            'description' => $request->description,
            'sub_activity_id' => $request->id,
            'budget' => $request->budget,
            'file' => $filename,
            'user_id' => auth()->user()->id,
        ]);
        toast('Realisasi Keuangan berhasil ditambahkan', 'success');
        return back();
    }

    public function cancelFinanceRealization(SubActivityBudgetHistory $id)
    {
        $id->load('getSubActivity');
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $plotSubActivity = PlottingSubActivity::where('month', $i)->where('sub_activity_id', $id->getSubActivity->id)->first();
                $newFinanceRealization = $plotSubActivity->finance_realization - $id->budget;
                $plotSubActivity->update([
                    'finance_realization' => $newFinanceRealization
                ]);
            }
        }

        $id->delete();
        toast('Realisasi Keuangan Berhasil Dibatalkan', 'success');
        return back();
    }

    public function selectEmployee(SubActivity $id, Request $request)
    {
        $request->validate([
            'worker' => 'required',
        ]);
        for ($i = 1; $i <= 12; $i++) {
            if ($i >= session('month')) {
                $plot = PlottingSubActivity::where('month', $i)->where('sub_activity_id', $id->id)->first();
                $plot->update([
                    'user_id' => $request->worker
                ]);
            }
        }

        toast('Pelaksana berhasil di update', 'success');
        return back();
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
