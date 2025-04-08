<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
{
    $lowongans = [
        [
            'judul' => 'Front-End Developer',
            'sisa_waktu' => '3 Hari Tersisa',
            'status' => 'Aktif',
            'label' => 'success',
        ],
        [
            'judul' => 'Front-End Developer',
            'sisa_waktu' => '',
            'status' => 'Diproses',
            'label' => 'info',
        ],
        [
            'judul' => 'Front-End Developer',
            'sisa_waktu' => '',
            'status' => 'Ditolak',
            'label' => 'danger',
        ],
        [
            'judul' => 'Front-End Developer',
            'sisa_waktu' => '',
            'status' => 'Selesai',
            'label' => 'danger',
        ],
    ];

    return view('Lowongan.index', compact('lowongans'));
}


    public function create()
    {
        return view('lowongan.create');
    }
}
