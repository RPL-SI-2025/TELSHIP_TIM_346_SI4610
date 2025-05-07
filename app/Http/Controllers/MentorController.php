<?php
 
 namespace App\Http\Controllers;
  
 use App\Models\UserMentor;
 use App\Models\Lowongan;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use App\Models\Lamaran;
 use App\Models\Laporan;
  
 class MentorController extends Controller
 {
     public function index()
     {
         $user = Auth::user();
         $usermentor = $user->mentor;
         $lowongans = Lowongan::all();
     
         return view('mentor.lowongan', compact('user', 'usermentor', 'lowongans'))
             ->with('activePage', 'mentor');
     }
  
         public function showLowongan()
     {
         $user = Auth::user(); // Ambil user login
         $usermentor = $user->mentor; // Ambil relasi UserMentor dari user
         $lowongans = Lowongan::where('id_mentor', $usermentor->id_mentor)->get(); // Ambil lowongan sesuai id mentor
  
         return view('mentor.lowongan', compact('user', 'usermentor', 'lowongans'))
             ->with('activePage', 'lowongan');
     }
  
     public function storeLowongan(Request $request)
     {
         $request->validate([
             'nama_posisi' => 'required',
             'deskripsi_pekerjaan' => 'required',
             'jumlah_kuota' => 'required|numeric',
             'durasi_magang' => 'required',
             'persyaratan' => 'required',
             'id_mentor' => 'required',
             'tanggal_lowongan' => 'required|date',
         ]);
  
         Lowongan::create([
             'nama_posisi' => $request->nama_posisi,
             'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
             'jumlah_kuota' => $request->jumlah_kuota,
             'durasi_magang' => $request->durasi_magang,
             'persyaratan' => $request->persyaratan,
             'id_mentor' => $request->id_mentor,
             'dibuka_sampai' => $request->tanggal_lowongan,
             'status' => 'menunggu' // Status default adalah menunggu
         ]);
  
         return redirect()->route('mentor.lowongan')->with('success', 'Lowongan berhasil ditambahkan dan menunggu persetujuan');
     }
  
     public function index_laporan()
     {
         // Ambil laporan yang statusnya 'diproses' dengan relasi yang benar
         $laporans = Laporan::with(['mahasiswa', 'mahasiswa.lamaran.lowongan'])
             ->whereHas('mahasiswa.lamaran', function ($query) {
                 $query->where('status', 'lolos');
             })
             ->where('status', 'diproses')
             ->get();
             // dd($laporans);
         return view('mentor.laporan', compact('laporans'));
     }
  
  
   
      public function terima($id_laporan)
      {
          $laporan = Laporan::findOrFail($id_laporan);
   
   
          $laporan->status = 'disetujui';
          $laporan->save();
   
          return redirect()->back()->with('success', 'Laporan diterima!');
      }
   
      public function tolak($id_laporan)
      {
          $laporan = Laporan::findOrFail($id_laporan);
   
          $laporan->status = 'ditolak';
          $laporan->save();
   
          return redirect()->back()->with('error', 'Laporan ditolak!');
      }
  
  
 }