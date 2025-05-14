<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MonitoringMahasiswaController extends Controller
{
    public function index()
    {
        // // Ambil semua mahasiswa beserta relasi hingga ke mitra
        // $mahasiswas = Mahasiswa::with([
        //     'lowongan.userMentor.mitra'
        // ])->get();

        // // Statistik mahasiswa
        // $total_mahasiswa = Mahasiswa::count();
        // $mahasiswa_aktif = Mahasiswa::where('status', 'Aktif')->count();
        // $mahasiswa_selesai = Mahasiswa::where('status', 'Selesai')->count();

        // return view('admin.monitoring.monitoring-mahasiswa', [
        //     'activePage' => 'monitoring',
        //     'mahasiswas' => $mahasiswas,
        //     'total_mahasiswa' => $total_mahasiswa,
        //     'mahasiswa_aktif' => $mahasiswa_aktif,
        //     'mahasiswa_selesai' => $mahasiswa_selesai,
        // ]);
    }
}
