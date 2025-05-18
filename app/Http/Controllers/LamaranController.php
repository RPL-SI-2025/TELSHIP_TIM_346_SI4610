	<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Lamaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Lowongan;
use App\Models\User;
 
 
class LamaranController extends Controller
{
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
 
        // Optional: Cek apakah sudah pernah melamar
        $sudahMelamar = Lamaran::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('id_lowongan', $request->id_lowongan)
            ->exists();
 
        if ($sudahMelamar) {
            return response()->json(['message' => 'Kamu sudah melamar untuk lowongan ini.'], 409);
        }
 
        Lamaran::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_lowongan' => $request->id_lowongan,
            'tanggal_lamaran' => now(),
            'status' => 'diproses',
        ]);
 
        return response()->json(['message' => 'Lamaran berhasil dikirim.']);
    }
 
    public function tolak($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->status = 'ditolak';
        $lamaran->sudah_direspon = 1;
        $lamaran->save();
 
        return response()->json([
            'success' => true,
            'message' => 'Lamaran ditolak.',
        ]);
    }
 
    public function terima($id)
    {
        $lamaran = Lamaran::findOrFail($id);
        $lamaran->status = 'lolos';
        $lamaran->sudah_direspon = 1;
        $lamaran->save();
 
        return response()->json([
            'success' => true,
            'message' => 'Lamaran diterima.',
        ]);
    }
 
 
 
 
 
 
 
}