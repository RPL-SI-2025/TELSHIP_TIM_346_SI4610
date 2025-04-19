<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil semua user yang rolenya 'mahasiswa' atau null
        $mahasiswas = User::where('role', 'mahasiswa')->get();

        return view('mahasiswa', compact('mahasiswas'));
    }
}
