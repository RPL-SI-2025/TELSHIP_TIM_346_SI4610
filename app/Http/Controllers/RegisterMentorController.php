<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterMentorController extends Controller
{
    public function show()
    {
        return view('registermentor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_perusahaan' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->nama,
            'id_perusahaan' => $request->id_perusahaan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // tambahkan role jika kamu ingin bedakan user dan mentor
            // 'role' => 'mentor',
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar mentor! Silakan login.');
    }
}
