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
 
        // $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();


        return view('landingpage.landingpage', compact('lowongans'));
    }
}