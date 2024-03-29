<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periods = Periode::orderBy('year', 'desc')->get();
        return view('secretary.period.index', compact('periods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required'
        ]);

        $check_periode = Periode::where('year', $request->year)->first();
        if (!empty($check_periode)) {
            toast("Data Periode Tahun $request->year sudah tersedia", 'error');
            return back();
        }

        Periode::create([
            'year' => $request->year,
        ]);

        toast('Data Periode berhasil ditambah', 'success');
        return back();
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        $period = Periode::where('id', $id)->first();
        $period->year = $request->year;
        $period->update();
        toast('Periode berhasil diubah', 'success');
        return back();
    }

    public function destroy($id)
    {
        $period = Periode::where('id', $id)->first();
        $period->delete();
        toast('Periode berhasil dihapus', 'success');
        return back();
    }

    public function selectPeriod()
    {
        $years = Periode::orderBy('year')->get();
        $period = [
            [
                'month' => 'Januari',
                'code' => 1,
            ],
            [
                'month' => 'Februari',
                'code' => 2,
            ],
            [
                'month' => 'Maret',
                'code' => 3,
            ],
            [
                'month' => 'April',
                'code' => 4,
            ],
            [
                'month' => 'Mei',
                'code' => 5,
            ],
            [
                'month' => 'Juni',
                'code' => 6,
            ],
            [
                'month' => 'Juli',
                'code' => 7,
            ],
            [
                'month' => 'Agustus',
                'code' => 8,
            ],
            [
                'month' => 'September',
                'code' => 9,
            ],
            [
                'month' => 'Oktober',
                'code' => 10,
            ],
            [
                'month' => 'November',
                'code' => 11,
            ],
            [
                'month' => 'Desember',
                'code' => 12,
            ],
        ];
        return view('/selectPeriod', compact('period', 'years'));
    }

    public function submitSelectPeriod(Request $request)
    {
        $year = Periode::where('id', $request->year)->first()->year;
        session(['month' => $request->month]);
        session(['year' => $request->year]);
        session(['monthName' => $request->monthName]);
        session(['yearName' => $year]);

        return redirect('/dashboard');
    }
}
