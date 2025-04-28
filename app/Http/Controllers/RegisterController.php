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
            'nama' => 'required|string|min:8',
            'nim' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[\W_]).+$/'
            ],
            'jurusan' => 'required|string|min:8',
            'no_hp' => 'required|digits_between:8,15|numeric',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.min' => 'Nama lengkap minimal 8 karakter.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.min' => 'NIM minimal 8 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung minimal 1 huruf besar dan 1 karakter spesial.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.min' => 'Jurusan minimal 8 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.digits_between' => 'Nomor HP harus antara 8 sampai 15 digit.',
            'no_hp.numeric' => 'Nomor HP hanya boleh angka.',
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