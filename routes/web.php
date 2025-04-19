<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store'); 