<?php

namespace App\Http\Controllers;

use App\Models\AdminLowongan;
use Illuminate\Http\Request;

class AdminLowonganController extends Controller
{
    public function index()
    {
        $jobs = AdminLowongan::where('status', 'pending')->get();
        return view('admin.lowongan.approval-request', compact('jobs'));
    }

    public function approve($id)
    {
        $job = AdminLowongan::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return redirect()->back()->with('success', 'Lowongan berhasil disetujui.');
    }

    public function reject($id)
    {
        $job = AdminLowongan::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return redirect()->back()->with('success', 'Lowongan berhasil ditolak.');
    }
}

