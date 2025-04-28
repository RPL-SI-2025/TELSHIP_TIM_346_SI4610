<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lowongans = Lowongan::with(['userMentor.mitra'])->where('status', 'disetujui')->get();
        
        $user = Auth::user();

        if ($user) {
            // Hanya ambil data mahasiswa jika sudah login
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        } else {
            $mahasiswa = null; // Jika belum login, set $mahasiswa menjadi null
        }

        return view('landingpage.landingpage', compact('lowongans', 'mahasiswa'));
    }

}