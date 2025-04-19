<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class LaporanController extends Controller
{
    public function index()
    {
        return view('mahasiswa.laporan_harian');
    }

    public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string|max:2000',
    ]);

    Laporan::create([
        // 'id_mahasiswa' => Auth::user()->mahasiswa->id_mahasiswa,
        'id_mahasiswa' => 1, // sementara
        'jenis_laporan' => 'laporan_harian',
        'tanggal' => $request->tanggal,
        'deskripsi_pekerjaan' => $request->deskripsi,
        'status' => 'diproses',
    ]);

    return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
}
}