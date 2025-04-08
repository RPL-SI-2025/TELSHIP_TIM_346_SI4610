<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;

class LowonganController extends Controller
{
    public function pelamar($id)
    {
        $lowongan = Lowongan::with('pelamar.mahasiswa')->findOrFail($id);
        return view('mentor.pelamar.index', compact('lowongan'));
    }

}
