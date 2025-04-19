<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    public function index($lowonganId)
    {
        $lamarans = Lamaran::with('pelamar')
            ->where('lowongan_id', $lowonganId)
            ->where('status', 'pending')
            ->get();

        return view('mentor.seleksi', compact('lamarans'));
    }

    public function terima($id)
    {
        $lamaran = Lamaran::findOrFail($id);

        // Cek apakah pelamar sudah diterima di tempat lain
        $alreadyAccepted = Lamaran::where('pelamar_id', $lamaran->pelamar_id)
            ->where('status', 'diterima')
            ->exists();

        if ($alreadyAccepted) {
            return redirect()->back()->with('error', 'Pelamar sudah diterima di tempat lain.');
        }

        $lamaran->status = 'diterima';
        $lamaran->save();

        return redirect()->back()->with('success', 'Pelamar diterima.');
    }

    // Fungsi tolak juga bisa ditambahkan
}
