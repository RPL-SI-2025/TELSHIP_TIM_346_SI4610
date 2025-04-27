<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterMentorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\AdminController;

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/pengguna', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/mahasiswa/update/{id}', [AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
    Route::delete('/admin/mahasiswa/delete/{id}', [AdminController::class, 'deleteMahasiswa'])->name('admin.mahasiswa.delete');
    Route::get('/admin/mentor', [AdminController::class, 'index_mentor'])->name('admin.mentor');
    Route::put('/admin/mentor/update/{id}', [AdminController::class, 'updateMentor'])->name('admin.mentor.update');
    Route::delete('/admin/mentor/delete/{id}', [AdminController::class, 'deleteMentor'])->name('admin.mentor.delete');
});


Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/registermentor', [RegisterMentorController::class, 'show'])->name('registermentor');
Route::post('/registermentor', [RegisterMentorController::class, 'store'])->name('registermentor.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
Route::get('/mahasiswa/profile', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::get('/mahasiswa/{id}/destroy', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

Route::get('/mahasiswa/laporan', [LaporanController::class, 'index_laporan'])->name('laporan.index');
Route::get('/mahasiswa/izin', [LaporanController::class, 'index_izin'])->name('izin.index');
Route::get('/mahasiswa/status', [LaporanController::class, 'index_status'])->name('status.index');
Route::post('/laporan', [LaporanController::class, 'store_laporan'])->name('laporan.store');
Route::post('/izin', [LaporanController::class, 'store_izin'])->name('izin.store');

Route::get('/mahasiswa/lowongan', [LowonganController::class, 'index_lowongan'])->name('lowongan.index');
Route::get('mahasiswa/lowongan/{id}', [LowonganController::class, 'show'])->name('lowongan.detail');
Route::post('/lamaran/store', [LamaranController::class, 'store'])->name('lamaran.store');
});