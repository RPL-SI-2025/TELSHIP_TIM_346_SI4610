<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        // // Validasi input
        // $request->validate([
        //     'nama_perusahaan' => 'required|string|max:255',
        //     'email' => 'required|email|unique:mitra,email',
        //     'telepon' => 'required',
        //     'alamat' => 'required',
        //     'deskripsi_perusahaan' => 'nullable|string',
        //     'link_website' => 'nullable|url',
        // ]);
    
        // // Simpan ke database
        // Mitra::create([
        //     'nama_perusahaan' => $request->nama_perusahaan,
        //     'email' => $request->email,
        //     'telepon' => $request->telepon,
        //     'alamat' => $request->alamat,
        //     'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
        //     'link_website' => $request->link_website,
        // ]);
    
        // // Redirect kembali dengan notifikasi sukses
        // return response()->json([
        //     'message' => 'Data mitra berhasil ditambahkan.',
        //     'status' => 'success'
        // ]);

    }
    
}
