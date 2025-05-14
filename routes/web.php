<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UstadzController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('santri', SantriController::class);
Route::resource('ustadz', UstadzController::class);
Route::resource('pelajaran', PelajaranController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('absensi', AbsensiController::class);
