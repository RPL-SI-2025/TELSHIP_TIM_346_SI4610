<?php
 
 namespace App\Http\Controllers;
  
 use App\Models\Lamaran;
 use Illuminate\Http\Request;
  
 class SeleksiController extends Controller
 {
    public function index($id_lowongan)
    {
        $lamarans = Lamaran::with(['lowongan', 'lowongan.usermentor'])
                            ->where('status', 'diproses')
                            ->where('id_lowongan', $id_lowongan)
                            ->get();

        return view('mentor.seleksi', compact('lamarans', 'id_lowongan'));
    }
    
  
     public function terima($id_lamaran)
     {
         $lamaran = Lamaran::findOrFail($id_lamaran);
  
  
         $lamaran->status = 'lolos';
         $lamaran->save();
  
         return redirect()->back()->with('success', 'Lamaran diterima!');
     }
  
     public function tolak($id_lamaran)
     {
         $lamaran = Lamaran::findOrFail($id_lamaran);
  
         $lamaran->status = 'ditolak';
         $lamaran->save();
  
         return redirect()->back()->with('error', 'Lamaran ditolak!');
     }
 }