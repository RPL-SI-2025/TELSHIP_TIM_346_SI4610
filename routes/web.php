<?php

use App\Http\Controllers\LowonganController;

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');

