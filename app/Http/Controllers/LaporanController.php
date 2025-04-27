<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class LaporanController extends Controller
{
    private function getMahasiswa()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            abort(403, 'Hanya mahasiswa yang bisa mengakses halaman ini.');
        }

        return $mahasiswa;
    }

    public function index_laporan()
    {
        $mahasiswa = $this->getMahasiswa();

        $laporans = Laporan::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('jenis_laporan', 'laporan_harian')
            ->orderByDesc('tanggal')
            ->get();

        return view('mahasiswa.laporan_harian', [
            'activePage' => 'laporan',
            'laporans' => $laporans,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function index_izin()
    {
        $mahasiswa = $this->getMahasiswa();

        $laporans = Laporan::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('jenis_laporan', 'izin')
            ->orderByDesc('tanggal')
            ->get();

        return view('mahasiswa.izin', [
            'activePage' => 'laporan',
            'laporans' => $laporans,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function index_status()
    {
        $mahasiswa = $this->getMahasiswa();

        $laporans = Laporan::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderByDesc('tanggal')
            ->get();

        return view('mahasiswa.status', [
            'activePage' => 'laporan',
            'laporans' => $laporans,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function store_laporan(Request $request)
    {
        $mahasiswa = $this->getMahasiswa();

        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:2000',
        ]);

        Laporan::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'jenis_laporan' => 'laporan_harian',
            'tanggal' => $request->tanggal,
            'deskripsi_pekerjaan' => $request->deskripsi,
            'status' => 'diproses',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    public function store_izin(Request $request)
    {
        $mahasiswa = $this->getMahasiswa();

        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:2000',
        ]);

        Laporan::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'jenis_laporan' => 'izin',
            'tanggal' => $request->tanggal,
            'deskripsi_pekerjaan' => $request->deskripsi,
            'status' => 'diproses',
        ]);

        return redirect()->back()->with('success', 'Izin berhasil dikirim!');
    }
}