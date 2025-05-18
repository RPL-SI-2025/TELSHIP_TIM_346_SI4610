<?php
 
namespace App\Http\Controllers;
 
use App\Models\Lowongan;
use Illuminate\Http\Request;
 
class AdminLowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::where('status', 'menunggu')->get();
        return view('admin.lowongan.approval-request', ['lowongans' => $lowongans, 'activePage' => 'lowongan'], compact('lowongans'));
    }
 
    public function approve($id)
    {
        $job = Lowongan::findOrFail($id);
        $job->status = 'disetujui';
        $job->save();
 
        return redirect()->back()->with('success', 'Lowongan berhasil disetujui.');
    }
 
    public function reject($id)
    {
        $job = Lowongan::findOrFail($id);
        $job->status = 'ditolak';
        $job->save();
 
        return redirect()->back()->with('success', 'Lowongan berhasil ditolak.');
    }
}