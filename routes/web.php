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
use App\Http\Controllers\MentorController;
use App\Http\Controllers\AdminLowonganController;
use App\Http\Controllers\MonitoringMahasiswaController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MonitoringLowonganController;

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/', function () {
    return view('index');
});

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/pengguna', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/mahasiswa/update/{id}', [AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
    Route::delete('/admin/mahasiswa/delete/{id}', [AdminController::class, 'deleteMahasiswa'])->name('admin.mahasiswa.delete');
    Route::get('/admin/mentor', [AdminController::class, 'index_mentor'])->name('admin.mentor');
    Route::put('/admin/mentor/update/{id}', [AdminController::class, 'updateMentor'])->name('admin.mentor.update');
    Route::delete('/admin/mentor/delete/{id}', [AdminController::class, 'deleteMentor'])->name('admin.mentor.delete');
    Route::post('admin/mentor/store', [AdminController::class, 'storeMentor'])->name('admin.mentor.store');
    Route::get('/admin/mitra', [AdminController::class, 'index_mitra'])->name('admin.mitra');
    Route::put('/admin/mitra/update/{id}', [AdminController::class, 'updateMitra'])->name('admin.mitra.update');
    Route::delete('/admin/mitra/delete/{id}', [AdminController::class, 'deleteMitra'])->name('admin.mitra.delete');
    Route::post('admin/mitra/store', [AdminController::class, 'storeMitra'])->name('admin.mitra.store');
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
// route seleski pelamar

});

Route::middleware(['auth'])->group(function () {
    Route::get('/mentor/lowongan', [MentorController::class, 'index'])->name('mentor.lowongan');
    Route::post('/mentor/lowongan/store', [MentorController::class, 'storeLowongan'])->name('mentor.lowongan.store');
    Route::get('/mentor/lowongan', [MentorController::class, 'showLowongan'])->name('mentor.lowongan');
    Route::get('/mentor/lowongan/{id}', [MentorController::class, 'showDetailLowongan'])->name('mentor.lowongan.detail');
    Route::get('/lowongan/{id}/pelamar', [LowonganController::class, 'pelamar'])->name('mentor.pelamar');
    Route::post('/pelamar/{id}/terima', [SeleksiController::class, 'terima'])->name('mentor.pelamar.terima');
    Route::post('/pelamar/{id}/tolak', [SeleksiController::class, 'tolak'])->name('mentor.pelamar.tolak');
    Route::get('/pelamar/{id}/profil', [SeleksiController::class, 'lihatProfil'])->name('mentor.pelamar.profil');
    Route::get('/seleksi/', [SeleksiController::class, 'index'])->name('seleksi');
    Route::post('/mentor/laporan/{id}/terima', [MentorController::class, 'terima'])->name('mentor.laporan.terima');
    Route::post('/mentor/laporan/{id}/tolak', [MentorController::class, 'tolak'])->name('mentor.laporan.tolak');
    Route::get('/mentor/laporan/{id}/deskripsi', [MentorController::class, 'lihatdeskripsi'])->name('mentor.laporan.deskripsi');
    Route::get('/mentor/laporan', [MentorController::class, 'index_laporan'])->name('mentor.laporan');
    Route::get('/mentor/lowongan/{lowonganId}/lamaran-lolos', [MentorController::class, 'getLolosLamaran'])->name('lamaran.getLolos');
});


Route::get('/admin/id-perusahaan/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/admin/id-perusahaan', [CompanyController::class, 'store'])->name('company.store');
Route::get('lowongan', [AdminLowonganController::class, 'index'])->name('lowongan.index');
Route::post('lowongan/{id}/approve', [AdminLowonganController::class, 'approve'])->name('lowongan.approve');
Route::post('lowongan/{id}/reject', [AdminLowonganController::class, 'reject'])->name('lowongan.reject');
Route::get('monitoring/mahasiswa', [MonitoringMahasiswaController::class, 'index'])->name('monitoring.mahasiswa');
Route::get('/monitoring/lowongan', [MonitoringLowonganController::class, 'index'])->name('monitoring.lowongan');

Route::get('/admin/lowongan/approval', [LowonganController::class, 'approvalIndex'])->name('lowongan.approval');
// Route::get('/admin/lowongan/{id}', [LowonganController::class, 'detailAdmin'])->name('lowongan.detail');
Route::post('/admin/lowongan/{id}/approve', [LowonganController::class, 'approve'])->name('lowongan.approve');
Route::post('/admin/lowongan/{id}/reject', [LowonganController::class, 'reject'])->name('lowongan.reject');