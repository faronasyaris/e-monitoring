<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Field;
use App\Models\Periode;
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
}
