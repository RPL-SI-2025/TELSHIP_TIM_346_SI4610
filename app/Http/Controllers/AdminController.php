<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\UserMentor;
use App\Models\Mitra;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        if ($admin) {
            $query = Mahasiswa::query();
            
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('nim', 'like', "%{$search}%")
                      ->orWhere('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            $mahasiswa = $query->paginate(10)->withQueryString();

            return view('admin.pengguna', [
                'activePage' => 'pengguna',
                'mahasiswa' => $mahasiswa,
            ]);
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function index_mentor()
    {
        $user = Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();
    
        if ($admin) {
            $query = UserMentor::with('user');
            
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('id_mentor', 'like', "%{$search}%")
                      ->orWhere('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            $usermentor = $query->paginate(10)->withQueryString();
            $mitra = Mitra::all();
    
            return view('admin.mentor', compact('usermentor', 'mitra'));
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function index_mitra()
    {
        $user = Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        if ($admin) {
            $query = Mitra::query();
            
            if (request('search')) {
                $search = request('search');
                $query->where(function($q) use ($search) {
                    $q->where('id_perusahaan', 'like', "%{$search}%")
                      ->orWhere('nama_perusahaan', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            $mitra = $query->paginate(10)->withQueryString();

            return view('admin.mitra', [
                'activePage' => 'mitra',
                'mitra' => $mitra,
            ]);
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required',
            'no_hp' => 'required',
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
            $mahasiswa = Mahasiswa::find($id);

            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }

            $mahasiswa->delete();

            return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    
    public function storeMentor(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:user_mentor,email',
            'password' => 'required|string|min:6',
            'id_perusahaan' => 'required|integer',
        ]);
    
        try {
            $user = new User();
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(60);
            $user->id_perusahaan = $request->id_perusahaan;
            $user->role = 'mentor';
            $user->save();
    
            // Save to the user_mentor table, including the hashed password
            $mentor = new UserMentor();
            $mentor->nama_lengkap = $request->nama_lengkap;
            $mentor->email = $request->email;
            $mentor->password = $user->password; // Use the same hashed password
            $mentor->id_perusahaan = $request->id_perusahaan;
            $mentor->user_id = $user->id;
            $mentor->save();
    
            return response()->json(['message' => 'Data Mentor berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['message' => 'Gagal menambahkan data: ' . $e->getMessage()]
            ], 422);
        }
    }

    public function updateMentor(Request $request, $id)
    {
        // Validasi input, sesuai dengan storeMentor
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users')->ignore($id, 'id'),
                \Illuminate\Validation\Rule::unique('user_mentor')->ignore($id, 'user_id'),
            ],
            'id_perusahaan' => 'required|integer',
        ]);
    
        try {
            // Log data yang diterima dari request
            \Log::info('Request data for updateMentor: ', $request->all());
    
            // Cari data di UserMentor berdasarkan user_id
            $mentor = UserMentor::where('user_id', $id)->first();
            if (!$mentor) {
                \Log::error('Mentor not found for user_id: ' . $id);
                return redirect()->back()->with('error', 'Data mentor tidak ditemukan.');
            }
    
            // Log data sebelum update
            \Log::info('Mentor data before update: ', $mentor->toArray());
    
            // Update data di UserMentor
            $mentor->nama_lengkap = $request->nama_lengkap;
            $mentor->email = $request->email;
            $mentor->id_perusahaan = $request->id_perusahaan;
            $mentor->save();
    
            // Log data setelah update
            \Log::info('Mentor data after update: ', $mentor->toArray());
    
            // Update data di tabel users
            $user = User::find($id);
            if ($user) {
                $user->name = $request->nama_lengkap;
                $user->email = $request->email;
                $user->id_perusahaan = $request->id_perusahaan;
                $user->save();
                \Log::info('User data after update: ', $user->toArray());
            } else {
                \Log::warning('User not found for id: ' . $id);
            }
    
            return redirect()->back()->with('success', 'Data mentor berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Error saat update mentor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function deleteMentor($id)
    {
        try {
            $mentor = UserMentor::findOrFail($id);

            if ($mentor->user) {
                $mentor->user->delete();
            }

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

    public function deleteMitra($id)
    {
        try {
            $mitra = Mitra::findOrFail($id);
            $mitra->delete();

            return redirect()->back()->with('success', 'Data mitra berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function storeMitra(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|email|unique:mitra,email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'deskripsi_perusahaan' => 'nullable|string',
            'link_website' => 'nullable|url',
        ]);

        try {
            $mitra = new Mitra();
            $mitra->nama_perusahaan = $request->nama_perusahaan;
            $mitra->email = $request->email;
            $mitra->telepon = $request->telepon;
            $mitra->alamat = $request->alamat;
            $mitra->deskripsi_perusahaan = $request->deskripsi_perusahaan;
            $mitra->link_website = $request->link_website;
            $mitra->save();

            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Data mitra berhasil ditambahkan.'
            // ]);
        } catch (\Exception $e) {
            return response()->json(['errors' => ['message' => 'Gagal menambahkan data: ' . $e->getMessage()]], 422);
        }
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

    public function downloadTemplate()
    {
        $templatePath = public_path('templates/template_mitra.xlsx');
        return response()->download($templatePath);
    }

}