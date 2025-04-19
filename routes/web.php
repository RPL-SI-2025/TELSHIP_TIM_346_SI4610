<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LowonganController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store'); 

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');