<?php

namespace App\Http\Controllers;

use App\Models\UserMentor;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;

class MentorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $usermentor = $user->mentor;
        $lowongans = Lowongan::all();
    
        return view('mentor.lowongan', compact('user', 'usermentor', 'lowongans'))
            ->with('activePage', 'mentor');
    }

        public function showLowongan()
    {
        $user = Auth::user(); // Ambil user login
        $usermentor = $user->mentor; // Ambil relasi UserMentor dari user
        $lowongans = Lowongan::where('id_mentor', $usermentor->id_mentor)->get(); // Ambil lowongan sesuai id mentor

        return view('mentor.lowongan', compact('user', 'usermentor', 'lowongans'))
            ->with('activePage', 'lowongan');
    }

    public function storeLowongan(Request $request)
    {
        $request->validate([
            'nama_posisi' => 'required',
            'deskripsi_pekerjaan' => 'required',
            'jumlah_kuota' => 'required|numeric',
            'durasi_magang' => 'required',
            'persyaratan' => 'required',
            'id_mentor' => 'required',
            'tanggal_lowongan' => 'required|date',
        ]);

        Lowongan::create([
            'nama_posisi' => $request->nama_posisi,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'jumlah_kuota' => $request->jumlah_kuota,
            'durasi_magang' => $request->durasi_magang,
            'persyaratan' => $request->persyaratan,
            'id_mentor' => $request->id_mentor,
            'dibuka_sampai' => $request->tanggal_lowongan,
            'status' => 'menunggu' // Status default adalah menunggu
        ]);

        return redirect()->route('mentor.lowongan')->with('success', 'Lowongan berhasil ditambahkan dan menunggu persetujuan');
    }

    public function showDetailLowongan($id)
    {
        $lowongans = Lowongan::findOrFail($id);
        $lamaranLolos = Lamaran::where('id_lowongan', $id)
        ->where('status', 'lolos')
        ->with([
            'mahasiswa.user',
            'mahasiswa.dokumen'
        ])
        ->get();
        $lamarans = Lamaran::with('mahasiswa') // Pastikan relasi mahasiswa ada di model Lamaran
            ->where('id_lowongan', $id)
            ->where('status', 'lolos') // Status yang diinginkan
            ->get();

        return view('mentor.lowongan_detail', compact('lowongans', 'lamarans','lamaranLolos'));
    }


    public function getLolosLamaran($lowonganId)
    {
        $lamaranLolos = Lamaran::where('id_lowongan', $lowonganId)
            ->where('status', 'lolos')
            ->with('mahasiswa')
            ->get();

        $data = $lamaranLolos->map(function ($item, $index) {
            return [
                'no' => $index + 1,
                'nama' => $item->mahasiswa->nama_lengkap ?? '-',
                'tanggal_lamaran' => $item->tanggal_lamaran,
                'status' => $item->status,
                'aksi' => '<button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalProfil-' . $item->id_lamaran . '">Lihat Profil</button>',
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    
}