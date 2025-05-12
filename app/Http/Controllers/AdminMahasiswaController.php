<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use PDF;

class AdminMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10);
        return view('admin.pengguna', compact('mahasiswa'));
    }

    public function exportPDF()
    {
        $mahasiswa = Mahasiswa::all();
        
        $pdf = PDF::loadView('admin.mahasiswa-pdf', [
            'mahasiswa' => $mahasiswa,
            'title' => 'Data Mahasiswa'
        ]);

        return $pdf->download('data-mahasiswa.pdf');
    }
} 