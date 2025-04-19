<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SeleksiController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store'); 

//route seleski pelamar
Route::get('/lowongan/{id}/pelamar', [LowonganController::class, 'pelamar'])->name('mentor.pelamar');
Route::post('/pelamar/{id}/terima', [PelamarController::class, 'terima'])->name('mentor.pelamar.terima');
Route::post('/pelamar/{id}/tolak', [PelamarController::class, 'tolak'])->name('mentor.pelamar.tolak');
Route::get('/pelamar/{id}/profil', [PelamarController::class, 'lihatProfil'])->name('mentor.pelamar.profil');
Route::get('/seleksi', [SeleksiController::class, 'index'])->name('seleksi');