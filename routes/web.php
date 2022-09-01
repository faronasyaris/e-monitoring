<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityOutcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramOutcomeController;
use App\Http\Controllers\SubActivityController;
use App\Http\Controllers\SubActivityOutputController;
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

    Route::get('/kegiatan', [ActivityController::class, 'index']);
    Route::get('/kegiatan/{id}/manage-kegiatan', [ActivityController::class, 'detailActivity']);


    Route::get('/program', [ProgramController::class, 'index']);
    Route::get('/program/{id}/manage-program', [ProgramController::class, 'detailProgram']);
    // Route::get('/program/{id}/tambah-kegiatan', [ActivityController::class, 'create']);
    // Route::post('/program/{id}/tambah-kegiatan', [ActivityController::class, 'store']);

    // Route::post('/kegiatan', [ActivityController::class, 'store']);
    // Route::get('/kegiatan/{id}/tambah-sub-kegiatan', [SubActivityController::class, 'create']);

    Route::get('/sub-kegiatan', [SubActivityController::class, 'index']);
    Route::get('/sub-kegiatan/{id}/manage-sub-kegiatan', [SubActivityController::class, 'detail']);

    // Route::get('/my-sub-kegiatan', [SubActivityController::class, 'getSubActivityByWorker']);

    Route::get('/selectPeriod', [PeriodeController::class, 'selectPeriod']);
    Route::post('/selectPeriod', [PeriodeController::class, 'submitSelectPeriod']);
});

Route::group(['middleware' => ['auth', 'isHeadDivision']], function () {
    Route::get('/approval', [SubActivityController::class, 'approval']);
    Route::post('/program', [ProgramController::class, 'store']);
    Route::put('/program/{id}', [ProgramController::class, 'update']);
    Route::delete('/program/{id}', [ProgramController::class, 'destroy']);
    Route::get('/program/{id}/getActivity', [ActivityController::class, 'getActivityByProgram']);

    Route::post('/programOutcome', [ProgramOutcomeController::class, 'store']);
    Route::put('/programOutcome/{id}', [ProgramOutcomeController::class, 'update']);
    Route::delete('/programOutcome/{id}', [ProgramOutcomeController::class, 'delete']);

    Route::post('/kegiatan', [ActivityController::class, 'store']);
    Route::put('/kegiatan/{id}', [ActivityController::class, 'update']);
    Route::delete('/kegiatan/{id}', [ActivityController::class, 'destroy']);

    Route::post('/kegiatanOutcome', [ActivityOutcomeController::class, 'store']);
    Route::put('/kegiatanOutcome/{id}', [ActivityOutcomeController::class, 'update']);
    Route::delete('/kegiatanOutcome/{id}', [ActivityOutcomeController::class, 'delete']);

    Route::put('/sub-kegiatan/{id}', [SubActivityController::class, 'update']);
    Route::delete('/sub-kegiatan/{id}', [SubActivityController::class, 'destroy']);
    Route::post('/sub-kegiatan/financeRealization', [SubActivityController::class, 'storeFinanceRealization']);
    Route::delete('/sub-kegiatan/financeRealization/{id}/cancel', [SubActivityController::class, 'cancelFinanceRealization']);
    Route::post('/sub-kegiatan', [SubActivityController::class, 'store']);
    Route::post('/sub-kegiatan/{id}/selectEmployee', [SubActivityController::class, 'selectEmployee']);

    Route::post('/subKegiatanOutcome', [SubActivityOutputController::class, 'store']);
    Route::put('/subKegiatanOutcome/{id}', [SubActivityOutputController::class, 'update']);
    Route::delete('/subKegiatanOutcome/{id}', [SubActivityOutputController::class, 'delete']);

    Route::post('/subKegiatan-achievment/{id}/add', [SubActivityOutputController::class, 'addAchievment']);
    Route::delete('/subKegiatan-achievment/{id}/cancel', [SubActivityOutputController::class, 'cancelAchievment']);

    Route::post('/achievment/{id}/add', [ProgramOutcomeController::class, 'addAchievment']);
    Route::delete('/achievment/{id}/cancel', [ProgramOutcomeController::class, 'cancelAchievment']);

    Route::post('/kegiatan-achievment/{id}/add', [ActivityOutcomeController::class, 'addAchievment']);
    Route::delete('/kegiatan-achievment/{id}/cancel', [ActivityOutcomeController::class, 'cancelAchievment']);
});

Route::group(['middleware' => ['auth', 'isSecretary']], function () {
    Route::get('/account', [UserController::class, 'listAccount']);
    Route::post('/account', [UserController::class, 'store']);
    Route::put('/account/{id}', [UserController::class, 'update']);
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
