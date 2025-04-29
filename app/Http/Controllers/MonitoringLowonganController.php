<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use App\Models\UserMentor;  
use Carbon\Carbon;

class MonitoringLowonganController extends Controller
{
    public function index()
    {
        // $lowongans = Lowongan::with('userMentor', 'userAdmin')->get(); 
        $lowongans = Lowongan::with(['userMentor.mitra', 'userAdmin'])->get(); 

        // Kalau mau hitung total peserta magang, lowongan aktif, peserta lulus
        $total_peserta = Mahasiswa::count();
        // $lowongan_aktif = Lowongan::where('status', 'Aktif')->count();
        // $peserta_lulus = Mahasiswa::where('status', 'Selesai')->count();

        // return view('admin.monitoring.monitoring-lowongan', compact('lowongans', 'total_peserta'));
        // dd($lowongans);
        return view('admin.monitoring.monitoring-lowongan', compact('lowongans', 'total_peserta'));
    }
}
