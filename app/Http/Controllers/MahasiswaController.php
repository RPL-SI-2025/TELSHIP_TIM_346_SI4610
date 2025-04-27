<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen;
use Illuminate\Support\Str;


class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        // Ambil data mahasiswa yang terkait dengan user
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        // Jika data mahasiswa belum ada, buat baru
        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->user_id = $user->id;
            $mahasiswa->nama_lengkap = $user->name;
            $mahasiswa->email = $user->email;
            $mahasiswa->save();
        }
        
        // Ambil data dokumen yang terkait dengan mahasiswa
        $dokumen = $mahasiswa->dokumen; // Menggunakan relasi dokumen
        
        // Kirim data ke view
        return view('mahasiswa.profile', compact('user', 'mahasiswa', 'dokumen'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jurusan' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'foto_profile' => 'nullable|image|max:2048',
            'cv' => 'nullable|url',
            'transkrip' => 'nullable|url',
            'ktp' => 'nullable|url',
            'sertifikat' => 'nullable|url',
            'dokumen_tambahan' => 'nullable|url',
        ]);

        // Ambil data user
        $user = User::findOrFail($id);
        
        // Ambil data mahasiswa terkait
        $mahasiswa = Mahasiswa::where('user_id', $id)->first();
        
        // Jika data mahasiswa belum ada, buat baru
        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->user_id = $user->id;
        }
        
        // Update data user
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        
        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        // Simpan perubahan user
        $user->save();
        
        // Update data mahasiswa
        $mahasiswa->nama_lengkap = $request->nama_lengkap;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->email = $request->email;
        
        // Proses upload foto profil
        if ($request->hasFile('foto_profile')) {
            $request->validate([
                'foto_profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        
            $file = $request->file('foto_profile');
            
            // Generate nama file dengan hash
            $extension = $file->getClientOriginalExtension();
            $filename = hash('sha256', time().Str::random(40)).'.'.$extension;
            
            // Hapus file lama jika ada
            if ($mahasiswa->foto_profile && Storage::disk('public')->exists('fotos/'.$mahasiswa->foto_profile)) {
                Storage::disk('public')->delete('fotos/'.$mahasiswa->foto_profile);
            }
            
            // Simpan file dengan stream content untuk menghindari masalah permission
            Storage::disk('public')->put('fotos/'.$filename, file_get_contents($file->getRealPath()));
            
            // Update database
            $mahasiswa->foto_profile = $filename;
            $mahasiswa->save();
        }
        
        // Update dokumen
        $dokumen = $mahasiswa->dokumen ? $mahasiswa->dokumen : new Dokumen();
        
        $dokumen->link_cv = $request->cv ?? $dokumen->link_cv;
        $dokumen->link_transkrip = $request->transkrip ?? $dokumen->link_transkrip;
        $dokumen->link_ktp = $request->ktp ?? $dokumen->link_ktp;
        $dokumen->link_sertifikat = $request->sertifikat ?? $dokumen->link_sertifikat;
        $dokumen->link_dokumen_tambahan = $request->dokumen_tambahan ?? $dokumen->link_dokumen_tambahan;
        
        // Simpan data dokumen
        $dokumen->id_mahasiswa = $mahasiswa->id_mahasiswa;
        $dokumen->save();
        
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }
}