<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminLowonganController;
use App\Http\Controllers\MonitoringMahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
Route::get('/admin/id-perusahaan/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/admin/id-perusahaan', [CompanyController::class, 'store'])->name('company.store');
Route::get('lowongan', [AdminLowonganController::class, 'index'])->name('lowongan.index');
Route::post('lowongan/{id}/approve', [AdminLowonganController::class, 'approve'])->name('lowongan.approve');
Route::post('lowongan/{id}/reject', [AdminLowonganController::class, 'reject'])->name('lowongan.reject');
Route::get('monitoring/mahasiswa', [MonitoringMahasiswaController::class, 'index'])->name('monitoring.mahasiswa');

