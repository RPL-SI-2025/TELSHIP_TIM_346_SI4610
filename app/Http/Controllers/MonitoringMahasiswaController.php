<?php
 
 namespace App\Http\Controllers;
  
 use App\Models\Mahasiswa;
 use App\Models\Lamaran;
 use Illuminate\Http\Request;
 use Carbon\Carbon;
 use App\Models\Lowongan;
 use Illuminate\Support\Str;
  
 class MonitoringMahasiswaController extends Controller
 {
     public function index()
     {
         $mahasiswas = Mahasiswa::whereHas('lamaran', function($query) {
             $query->where('status', 'lolos');
         })->with(['lamaran' => function($query) {
             $query->where('status', 'lolos')->with('lowongan.userMentor.mitra');
         }])->get();
  
         $total_mahasiswa = Lamaran::where('status', 'lolos')
             ->whereDate('updated_at', '>=', Carbon::now()->subMonths(3))//perumpamaan 3 bulan
             ->count();                
         $mahasiswa_selesai = Lamaran::where('status', 'lolos')
             ->whereDate('updated_at', '<', Carbon::now()->subMonths(3))
             ->count();
         $lowongan_aktif = Lowongan::where('status', 'disetujui')
         ->get()
         ->filter(function ($lowongan) {
             $tanggalSekarang = \Carbon\Carbon::now();
             $tanggalDibukaSampai = \Carbon\Carbon::parse($lowongan->dibuka_sampai);
             // ngammbil angka dari durasi_magang seperti "30 hari"
             preg_match('/(\d+)/', $lowongan->durasi_magang, $matches);
             $durasiMagangHari = isset($matches[1]) ? (int) $matches[1] : 0;
             // ngitung tanggal selesai magang = dibuka_sampai + durasi
             $tanggalSelesaiMagang = $tanggalDibukaSampai->copy()->addDays($durasiMagangHari);
             // kalo tanggal sekarang <= tanggal selesai magang, berarti masih aktif
             return $tanggalSekarang->lte($tanggalSelesaiMagang);
         })
         ->count();
  
 // dd($mahasiswas);
         return view('admin.monitoring.monitoring-mahasiswa', [
             'activePage' => 'monitoring',
             'mahasiswas' => $mahasiswas,
             'total_mahasiswa' => $total_mahasiswa,
             'mahasiswa_selesai' => $mahasiswa_selesai,
             'lowongan_aktif' => $lowongan_aktif,
         ]);
     }
 }