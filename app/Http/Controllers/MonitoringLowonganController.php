<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Mahasiswa;
use App\Models\UserMentor;
use App\Models\Lamaran;  
use Carbon\Carbon;

class MonitoringLowonganController extends Controller
{
    public function index()
    {
        // $lowongans = Lowongan::with('userMentor', 'userAdmin')->get(); 
        $lowongans = Lowongan::with(['userMentor.mitra', 'userAdmin'])->get(); 

        // Kalau mau hitung total peserta magang, lowongan aktif, peserta lulus
        // $total_peserta = Mahasiswa::count();
        // $lowongan_aktif = Lowongan::where('status', 'Aktif')->count();
        // $peserta_lulus = Mahasiswa::where('status', 'Selesai')->count();
        // Jumlah mahasiswa magang aktif (< 3 bulan)
        $total_mahasiswa = Lamaran::where('status', 'lolos')
            ->whereDate('updated_at', '>=', Carbon::now()->subMonths(3))
            ->count();

        // Jumlah mahasiswa magang selesai (≥ 3 bulan)
        $mahasiswa_selesai = Lamaran::where('status', 'lolos')
            ->whereDate('updated_at', '<', Carbon::now()->subMonths(3))
            ->count();

        // Hitung jumlah lowongan yang masih aktif berdasarkan durasi dan dibuka_sampai
        $lowongan_aktif = Lowongan::where('status', 'disetujui')
            ->get()
            ->filter(function ($lowongan) {
                $tanggalSekarang = Carbon::now();
                $tanggalDibukaSampai = Carbon::parse($lowongan->dibuka_sampai);
                preg_match('/(\d+)/', $lowongan->durasi_magang, $matches);
                $durasiMagangHari = isset($matches[1]) ? (int) $matches[1] : 0;
                $tanggalSelesaiMagang = $tanggalDibukaSampai->copy()->addDays($durasiMagangHari);
                return $tanggalSekarang->lte($tanggalSelesaiMagang);
            })
            ->count();

        // return view('admin.monitoring.monitoring-lowongan', compact('lowongans', 'total_peserta'));
        // dd($lowongans);
        return view('admin.monitoring.monitoring-lowongan', [
            'activePage' => 'monitoring',
            'lowongans' => $lowongans,
            'total_mahasiswa' => $total_mahasiswa,
            'mahasiswa_selesai' => $mahasiswa_selesai,
            'lowongan_aktif' => $lowongan_aktif,
        ]);
    }
}
