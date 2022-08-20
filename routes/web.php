<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramOutcomeController;
use App\Http\Controllers\SubActivityController;
use App\Models\SubActivity;

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

Route::group(['mddileware' => 'guest'], function () {
    Route::get('/', function () {
        return redirect()->intended('/login');
    });

    Route::get('/login', [UserController::class, 'loginView'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/dashboard', [UserController::class, 'dashboard']);

    Route::get('/program', [ProgramController::class, 'index']);
    Route::get('/program/{id}/manage-program', [ProgramController::class, 'detailProgram']);
    Route::get('/program/{id}/tambah-kegiatan', [ActivityController::class, 'create']);
    Route::post('/program/{id}/tambah-kegiatan', [ActivityController::class, 'store']);

    Route::get('/kegiatan', [ActivityController::class, 'index']);
    Route::get('/kegiatan/{id}/manage-kegiatan', [ActivityController::class, 'detailActivity']);
    Route::post('/kegiatan', [ActivityController::class, 'store']);
    Route::get('/kegiatan/{id}/tambah-sub-kegiatan', [SubActivityController::class, 'create']);

    Route::get('/sub-kegiatan', [SubActivityController::class, 'index']);
    Route::get('/my-sub-kegiatan', [SubActivityController::class, 'getSubActivityByWorker']);
    Route::get('/sub-kegiatan/{id}/manage-sub-kegiatan', [SubActivityController::class, 'detailSubActivity']);
    Route::post('/sub-kegiatan', [SubActivityController::class, 'store']);

    Route::get('/selectPeriod', [PeriodeController::class, 'selectPeriod']);
    Route::post('/selectPeriod', [PeriodeController::class, 'submitSelectPeriod']);
});

Route::group(['middleware' => ['auth', 'isHeadDivision']], function () {
    Route::post('/programOutcome', [ProgramOutcomeController::class, 'store']);

    Route::post('/achievment/{id}/add', [ProgramOutcomeController::class, 'addAchievment']);
    Route::delete('/achievment/{id}/cancel', [ProgramOutcomeController::class, 'cancelAchievment']);

    Route::get('/approval', [SubActivityController::class, 'approval']);
    Route::post('/program', [ProgramController::class, 'store']);
    Route::post('/program/{id}', [ProgramController::class, 'update']);
    Route::delete('/program/{id}', [ProgramController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'isSecretary']], function () {
    Route::get('/account', [UserController::class, 'listAccount']);
    Route::post('/account', [UserController::class, 'store']);
    Route::delete('/account/{id}', [UserController::class, 'destroy']);
    Route::get('/period', [PeriodeController::class, 'index']);
    Route::post('/period', [PeriodeController::class, 'store']);
    Route::post('/period/{id}', [PeriodeController::class, 'update']);
    Route::delete('/period/{id}', [PeriodeController::class, 'destroy']);
    Route::get('/field/{id}/head', [FieldController::class, 'checkField']);
});

Route::group(['middleware' => ['auth', 'isEmployee']], function () {
    Route::post('/sub-kegiatan/submit-progress', [SubActivityController::class, 'submitProgress']);
});



//Sekertaris
// Route::get('/dashboardSekertaris', function () {
//     return view('secretary/dashboard');
// });
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
// Route::get('/dashboardKepalaDinas', function () {
//     return view('headOfDepartment/dashboard');
// });
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
// Route::get('/dashboardKepalaBidang', function () {
//     return view('headOfDivision/dashboard');
// });
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
