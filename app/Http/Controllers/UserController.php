<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Field;
use App\Models\Periode;
use App\Models\Program;
use App\Models\Activity;
use PDF;
use App\Models\SubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'Sekretaris') {
                return redirect('/dashboard');
            }

            return redirect('/selectPeriod');
        }
        toast('Email atau Password Salah', 'error');
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard()
    {
        $user = Auth::User();
        if ($user->role == 'Sekretaris') {
            $users = User::all();
            $period = Periode::all();
            return view('secretary.dashboard', compact('users', 'period'));
        }

        if ($user->role == 'Pelaksana') {
            $subActivities = SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'))->where('user_id', auth()->user()->id);
            })->where('year', session('year'))->where('field_id', auth()->user()->field_id)->get();
            $data['totalBudget'] = 0;
            $data['totalRealization'] = 0;
            foreach ($subActivities as $subActivity) {
                $data['totalBudget'] += $subActivity->getPlotting->where('month', session('month'))->first()->budget;
                $data['totalRealization']  += $subActivity->getPlotting->where('month', session('month'))->first()->finance_realization;
            }
            return view('employee.dashboard', compact('subActivities'))->with($data);
        }

        if ($user->role == 'Kepala Dinas') {
            $programs =  Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            $activities =  Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            $subActivities =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();

            $data['totalBudget'] = 0;
            $data['totalRealization'] = 0;
            foreach ($programs as $program) {
                $countFinance = Program::countProgramFinance($program->id);
                $data['totalBudget'] += $countFinance['totalBudget'];
                $data['totalRealization'] += $countFinance['totalFinance'];
            }

            return view('headOfDepartement.dashboard', compact('programs', 'activities', 'subActivities'))->with($data);
        }

        if ($user->role == 'Kepala Bidang') {
            $programs =  Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            $activities =  Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            $subActivities =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();

            $data['totalBudget'] = 0;
            $data['totalRealization'] = 0;
            foreach ($programs as $program) {
                $countFinance = Program::countProgramFinance($program->id);
                $data['totalBudget'] += $countFinance['totalBudget'];
                $data['totalRealization'] += $countFinance['totalFinance'];
            }
            return view('headOfDivision.dashboard', compact('programs', 'activities', 'subActivities'))->with($data);
        }
    }

    public function listAccount()
    {
        $kepalaDinas = User::where('role', 'Kepala Dinas')->first();
        $masters = User::where('role', 'Sekretaris')->orWhere('role', 'Kepala Dinas')->get();
        $fields = Field::with('getUser')->get();
        return view('secretary.account.index', compact('fields', 'masters', 'kepalaDinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nip' => 'required',
            'role' => 'required'
        ]);

        $password = bcrypt($request->nip);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'nip' => $request->nip,
            'role' => $request->role,
            'field_id' => $request->field
        ]);

        toast('Data Akun berhasil ditambah', 'success');
        return back();
    }

    public function update(User $id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'nip' => 'required'
        ]);

        $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip
        ]);

        toast('Data Akun berhasil diupdate', 'success');
        return back();
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user_name = $user->name;
        if ($user->id == Auth::user()->id) {
            toast('Anda tidak dapat menghapus akun anda sendiri!', 'error');
            return back();
        }
        $user->delete();
        toast('Data akun ' . $user_name . ' dihapus', 'success');
        return back();
    }

    public function reportView()
    {
        if (auth()->user()->role == 'Kepala Bidang') {
            $programs =  Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            $activities =  Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            $subActivities =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
        } else if (auth()->user()->role == 'Kepala Dinas') {
            $programs =  Program::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            $activities =  Activity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
            $subActivities =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                $query->where('month', session('month'));
            })->where('year', session('year'))->get();
        }
        return view('report', compact('programs', 'activities', 'subActivities'));
    }

    public function downloadReport(Request $request)
    {
        $request->validate([
            'report' => 'required'
        ]);

        if ($request->report == 'program') {
            if (auth()->user()->role == 'Kepala Bidang') {
                $data =  Program::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            } else if (auth()->user()->role == 'Kepala Dinas') {
                $data =  Program::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('year', session('year'))->get();
            }
            $pdf = PDF::loadview('layouts.program_pdf', ['data' => $data]);
            $pdf->setPaper('A4', 'landscape');
            $file =  "report_program" . "_" .  date('Ymdhis') . ".pdf";
            return $pdf->download($file);
        }
        if ($request->report == 'kegiatan') {
            if (auth()->user()->role == 'Kepala Bidang') {
                $data =  Activity::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            } else if (auth()->user()->role == 'Kepala Dinas') {
                $data =  Activity::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('year', session('year'))->get();
            }
            $pdf = PDF::loadview('layouts.activity_pdf', ['data' => $data]);
            $pdf->setPaper('A4', 'landscape');
            $file =  "report_kegiatan" . "_" .  date('Ymdhis') . ".pdf";
            return $pdf->download($file);
        }
        if ($request->report == 'subKegiatan') {
            if (auth()->user()->role == 'Kepala Bidang') {
                $data =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('field_id', auth()->user()->field_id)->where('year', session('year'))->get();
            } else if (auth()->user()->role == 'Kepala Dinas') {
                $data =  SubActivity::withAndWhereHas('getPlotting', function ($query) {
                    $query->where('month', session('month'));
                })->where('year', session('year'))->get();
            }
            $pdf = PDF::loadview('layouts.sub_activity_pdf', ['data' => $data]);
            $pdf->setPaper('A4', 'landscape');
            $file =  "report_subKegiatan" . "_" .  date('Ymdhis') . ".pdf";
            return $pdf->download($file);
        }
    }
}
