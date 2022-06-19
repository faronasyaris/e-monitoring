<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

//Sekertaris
Route::get('/dashboardSekertaris', function () {
    return view('secretary/dashboard');
});
Route::get('/kelolaDataAkun', function () {
    return view('secretary/kelolaDataAkun');
});
Route::get('/formAkun', function () {
    return view('secretary/formAkun');
});
Route::get('/lihatLaporanAkun', function () {
    return view('secretary/lihatLaporanAkun');
});

//Kepala Dinas
Route::get('/dashboardKepalaDinas', function () {
    return view('headOfDepartment/dashboard');
});
Route::get('/dataProgram', function () {
    return view('headOfDepartment/dataProgram');
});
Route::get('/progresProgram', function () {
    return view('headOfDepartment/progresProgram');
});
Route::get('/laporanAkhir', function () {
    return view('headOfDepartment/laporanAkhir');
});
//Kepala Bidang
Route::get('/dashboardKepalaBidang', function () {
    return view('headOfDivision/dashboard');
});
Route::get('/kelolaDataProgram', function () {
    return view('headOfDivision/kelolaDataProgram');
});

Route::get('/kelolaDataKegiatan', function () {
    return view('headOfDivision/KelolaDataKegiatan');
});
//Pegawai
Route::get('/kelolaDataSubKegiatan', function () {
    return view('headOfDivision/KelolaDataSubKegiatan');
});
Route::get('/dashboardPegawai', function () {
    return view('employee/dashboard');
});
Route::get('/subKegiatan', function () {
    return view('employee/subKegiatan');
});
Route::get('/capaianPelaksanaan', function () {
    return view('employee/capaianPelaksanaan');
});
