<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;


class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'jurusan' => 'required|string',
            'no_hp' => 'required|string',
        ]);

    try {
        // Simpan user dulu
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        // Simpan mahasiswa dan hubungkan ke user
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jurusan' => $request->jurusan,
            'no_hp' => $request->no_hp,
            'user_id' => $user->id,
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar! Silakan login.');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
    }
}

}