<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UstadzController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('santri', SantriController::class);
    Route::resource('ustadz', UstadzController::class);
    Route::resource('pelajaran', PelajaranController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('absensi', AbsensiController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas',
    ]);
});