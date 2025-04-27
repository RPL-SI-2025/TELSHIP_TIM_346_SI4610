<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitoringMahasiswaController extends Controller
{
    public function index()
    {
        // Simulasi data mahasiswa (nanti bisa diambil dari database kalau mau)
        $dataMahasiswa = [
            [
                'nim' => '1202220000',
                'nama' => 'Muhammad Naufal',
                'jurusan' => 'S1 Sistem Informasi',
                'no_hp' => '0821211121334',
                'perusahaan' => 'PT. Telkom',
                'status' => 'Selesai',
            ],
            [
                'nim' => '1202220000',
                'nama' => 'Muhammad Naufal',
                'jurusan' => 'S1 Sistem Informasi',
                'no_hp' => '0821211121334',
                'perusahaan' => 'PT. Telkom',
                'status' => 'Berlangsung',
            ],
        ];

        return view('admin.monitoring.monitoring-mahasiswa', compact('dataMahasiswa'));
    }
}