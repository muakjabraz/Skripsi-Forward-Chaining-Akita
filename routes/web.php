<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/testpage', function () {
//     return view('index');
// });

Route::group(['middleware' => ['role:admin,dokter,perawat', 'auth']], function () {
    // Route::get('/', [AppController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AppController::class, 'dashboard'])->name('dashboard');
    Route::resource('/pasien', PasienController::class);
});


Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('/user_admin', [UserController::class, 'admin_index'])->name('admin_index');
    Route::get('/user_pakar', [UserController::class, 'pakar_index'])->name('pakar_index');
    Route::get('/user_perawat', [UserController::class, 'perawat_index'])->name('perawat_index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');
});


Route::group(['middleware' => ['role:perawat', 'auth']], function () {
    Route::get('/sistem_pakar', [AppController::class, 'sistem_pakar'])->name('sistem_pakar');
    Route::post('/hasil_pakar', [AppController::class, 'hasil_pakar'])->name('hasil_pakar');
});

Route::group(['middleware' => ['role:dokter', 'auth']], function () {
    Route::resource('/gejala', GejalaController::class);
    Route::resource('/penyakit', PenyakitController::class);
    Route::post('/tambah_gejala_aturan', [AturanController::class, 'tambah_gejala_aturan'])->name('tambah_gejala_aturan');
    Route::delete('/hapus_gejala_aturan/{id}', [AturanController::class, 'hapus_gejala_aturan'])->name('hapus_gejala_aturan');
    Route::put('/change_status/{id}', [AturanController::class, 'change_status'])->name('change_status');
});

Route::group(['middleware' => ['role:dokter,perawat', 'auth']], function () {
    Route::get('/kasus', [AppController::class, 'kasus_index'])->name('kasus_index');
    Route::get('/kasus_report', [AppController::class, 'kasus_report'])->name('kasus_report');
    Route::resource('/aturan', AturanController::class);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
    Route::get('/', [AppController::class, 'index'])->name('index');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
