<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;
use App\Models\Mitra;
use App\Models\UserMentor;
 
class LowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index_lowongan()
    {
        $user = Auth::user();
 
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
 
        if (!$mahasiswa) {
            return redirect()->route('/login')->with('error', 'Hanya mahasiswa yang bisa mengakses halaman ini.');
        }
 
        $id_mahasiswa = $mahasiswa->id_mahasiswa;
 
        // Ambil daftar nama perusahaan unik
        $daftarPerusahaan = Mitra::whereHas('userMentor.lowongans', function ($q) {
            $q->where('status', 'disetujui');
        })->pluck('nama_perusahaan');
 
        // Ambil semua lowongan disetujui
        $query = Lowongan::with(['userMentor.mitra'])
            ->where('status', 'disetujui');
 
        // Filter berdasarkan perusahaan jika ada
        if (request()->filled('perusahaan')) {
            $query->whereHas('userMentor.mitra', function ($q) {
                $q->where('nama_perusahaan', request('perusahaan'));
            });
        }
 
        $lowongans = $query->get();
 
        return view('mahasiswa.lowongan', [
            'activePage' => 'laporan',
            'lowongans' => $lowongans,
            'id_mahasiswa' => $id_mahasiswa,
            'mahasiswa' => $mahasiswa,
            'daftarPerusahaan' => $daftarPerusahaan, // dikirim ke view
        ]);
    }
 
    
 
 
    public function show($id)
    {
 
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
 
        if (!$mahasiswa) {
            return redirect()->route('/login')->with('error', 'Hanya mahasiswa yang bisa mengakses halaman ini.');
        }
 
        $id_mahasiswa = $mahasiswa->id_mahasiswa;
 
        $lowongans = Lowongan::findOrFail($id);
        return view('mahasiswa.detail_lowongan', [
            'activePage' => 'laporan',
            'lowongans' => $lowongans,
            'id_mahasiswa' => $id_mahasiswa,
            'mahasiswa' => $mahasiswa,
        ]);
    }
    public function approvalIndex()
    {
        // Hanya ambil lowongan dengan status 'menunggu'
        $lowongans = Lowongan::with(['userMentor.mitra'])
                         ->where('status', 'menunggu')
                         ->get();
                         
        return view('admin.lowongan.approval-request', [
            'lowongans' => $lowongans, 
            // 'activePage' => 'lowongan'
        ]);
    }
   
    /**
     * Menampilkan detail lowongan untuk admin
     */
    // public function detailAdmin($id)
    // {
    //     $lowongan = Lowongan::with(['userMentor.mitra'])->findOrFail($id);
    //     return view('admin.detail_lowongan', [
    //         'lowongan' => $lowongan
    //     ]);
    // }
   
    /**
     * Menyetujui lowongan
     */
    public function approve($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->status = 'disetujui';
        $lowongan->save();
       
        return redirect()->route('lowongan.approval')
                        ->with('success', 'Lowongan berhasil disetujui.');
    }
   
    /**
     * Menolak lowongan
     */
    public function reject($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->status = 'ditolak';
        $lowongan->save();
       
        return redirect()->route('lowongan.approval')
                        ->with('success', 'Lowongan berhasil ditolak.');
    }
}