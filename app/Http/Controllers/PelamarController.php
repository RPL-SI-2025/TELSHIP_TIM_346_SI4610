<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function terima($id) {
        $pelamar = Pelamar::findOrFail($id);
    
        // Cek apakah sudah diterima di tempat lain
        if (Pelamar::where('mahasiswa_id', $pelamar->mahasiswa_id)->where('status', 'diterima')->exists()) {
            return back()->with('error', 'Pelamar telah diterima di lowongan lain.');
        }
    
        $pelamar->status = 'diterima';
        $pelamar->save();
    
        return back()->with('success', 'Pelamar berhasil diterima');
    }
    
    public function tolak($id) {
        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status = 'ditolak';
        $pelamar->save();
    
        return back()->with('success', 'Pelamar berhasil ditolak');
    }
    
    public function lihatProfil($id) {
        $pelamar = Pelamar::with('mahasiswa')->findOrFail($id);
        return view('mentor.lowongan.detail_pelamar', compact('pelamar'));
    }
}
