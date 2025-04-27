<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\UserMentor;
use App\Models\Mitra;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $admin = Admin::where('user_id', $user->id)->first();
        if ($admin) {
            $mahasiswa = Mahasiswa::paginate(10);

            return view('admin.pengguna', [
                'activePage' => 'pengguna',
                'mahasiswa' => $mahasiswa,
            ]);
        } else {
            return redirect('/')->with('error', 'You do not have admin access.');
        }
    }

    public function index_mentor()
    {
        $user = Auth::user();

        $admin = Admin::where('user_id', $user->id)->first();
        if ($admin) {
            $mentor = UserMentor::paginate(10);

            return view('admin.mentor', [
                'activePage' => 'mentor',
                'usermentor' => $mentor,
            ]);
        } else {
            return redirect('/')->with('error', 'You do not have admin access.');
        }
    }

    public function index_mitra()
    {
        $user = Auth::user();

        $admin = Admin::where('user_id', $user->id)->first();
        if ($admin) {
            $mitra = Mitra::paginate(10);

            return view('admin.mitra', [
                'activePage' => 'mitra',
                'mitra' => $mitra,
            ]);
        } else {
            return redirect('/')->with('error', 'You do not have admin access.');
        }
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required',
            'no_hp' => 'required'
        ]);

        try {
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }

            $mahasiswa = Mahasiswa::where('user_id', $id)->first();
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }

            // Update data mahasiswa
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama_lengkap = $request->nama_lengkap;
            $mahasiswa->email = $request->email;
            $mahasiswa->jurusan = $request->jurusan;
            $mahasiswa->no_hp = $request->no_hp;
            $mahasiswa->save();

            return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function deleteMahasiswa($id)
    {
        try {
            // Cari mahasiswa berdasarkan ID
            $mahasiswa = Mahasiswa::find($id);

            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }

            // Hapus mahasiswa
            $mahasiswa->delete();

            return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


    

    public function updateMentor(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'id_perusahaan' => 'required',
            'user_id' => 'required'
        ]);

        try {
            $mentor = UserMentor::find($id);
            if (!$mentor) {
                return redirect()->back()->with('error', 'Data mentor tidak ditemukan.');
            }

            // Update data UserMentor
            $mentor->nama_lengkap = $request->nama_lengkap;
            $mentor->email = $request->email;
            $mentor->id_perusahaan = $request->id_perusahaan;
            $mentor->user_id = $request->user_id;
            $mentor->save();

            return redirect()->back()->with('success', 'Data mentor berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function deleteMentor($id)
    {
        try {
            $mentor = UserMentor::findOrFail($id);

            // Hapus user terkait juga kalau mau
            if ($mentor->user) {
                $mentor->user->delete();
            }

            // Hapus UserMentor
            $mentor->delete();

            return redirect()->back()->with('success', 'Data mentor dan user berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function updateMitra(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'deskripsi_perusahaan' => 'nullable|string',
            'link_website' => 'nullable|url',
        ]);

        try {
            $mitra = Mitra::find($id);
            if (!$mitra) {
                return redirect()->back()->with('error', 'Data mitra tidak ditemukan.');
            }

            // Update data mitra
            $mitra->nama_perusahaan = $request->nama_perusahaan;
            $mitra->email = $request->email;
            $mitra->telepon = $request->telepon;
            $mitra->alamat = $request->alamat;
            $mitra->deskripsi_perusahaan = $request->deskripsi_perusahaan;
            $mitra->link_website = $request->link_website;
            $mitra->save();

            return redirect()->back()->with('success', 'Data mitra berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    // Add method for deleting mitra data
    public function deleteMitra($id)
    {
        try {
            $mitra = Mitra::findOrFail($id);

            // Hapus mitra
            $mitra->delete();

            return redirect()->back()->with('success', 'Data mitra berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
