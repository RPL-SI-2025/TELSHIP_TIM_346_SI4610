<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;

class JobApprovalController extends Controller
{
    public function index()
    {
        $jobs = Jobs::all();
        return view('admin.lowongan.index', compact('jobs'));
    }

    public function approve($id)
    {
        $job = Jobs::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return back()->with('success', 'Lowongan disetujui.');
    }

    public function reject($id)
    {
        $job = Jobs::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return back()->with('success', 'Lowongan ditolak.');
    }
}
