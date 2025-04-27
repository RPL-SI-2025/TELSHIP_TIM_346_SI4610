<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;

class LowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_lowongan()
    {

        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->route('/login')->with('error', 'Hanya mahasiswa yang bisa mengakses halaman ini.');
        }

        $id_mahasiswa = $mahasiswa->id_mahasiswa;

        $lowongans = Lowongan::with(['userMentor.mitra'])->where('status', 'disetujui')->get();

        return view('mahasiswa.lowongan', [
            'activePage' => 'laporan',
            'lowongans' => $lowongans,
            'id_mahasiswa' => $id_mahasiswa,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function show($id)
    {

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->route('/login')->with('error', 'Hanya mahasiswa yang bisa mengakses halaman ini.');
        }

        $id_mahasiswa = $mahasiswa->id_mahasiswa;

        $lowongans = Lowongan::findOrFail($id);
        return view('mahasiswa.detail_lowongan', [
            'activePage' => 'laporan',
            'lowongans' => $lowongans,
            'id_mahasiswa' => $id_mahasiswa,
            'mahasiswa' => $mahasiswa,
        ]);
    }
}