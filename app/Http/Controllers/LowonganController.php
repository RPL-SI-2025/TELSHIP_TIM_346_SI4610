<?php

use App\Models\Lowongan;

class SeleksiController extends Controller
{
    public function pelamar($id)
    {
        // Mengambil data lowongan beserta relasi pelamar dan mahasiswa
        $lowongan = Lowongan::with('pelamar.mahasiswa')->findOrFail($id);

        // Menampilkan view tanpa harus login
        return view('mentor.index', compact('lowongan'));
    }
}

