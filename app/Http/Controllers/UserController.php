<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Field;
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
            return redirect('/dashboard');
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
            return view('secretary.dashboard');
        }

        if ($user->role == 'employee') {
            return view('employee.dashboard');
        }

        if ($user->role == 'Kepala Dinas') {
            return view('headOfDepartement.dashboard');
        }

        if ($user->role == 'Kepala Bidang') {
            return view('headOfDivision.dashboard');
        }
    }

    public function listAccount()
    {
        $masters = User::where('role', 'Sekretaris')->orWhere('role', 'Kepala Dinas')->get();
        $fields = Field::with('getUser')->get();
        return view('secretary.listField', compact('fields','masters'));
    }
}
