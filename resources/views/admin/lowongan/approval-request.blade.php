@extends('partials_admin.template')

@section('title', 'Approval Lowongan')

@section('main')
<div style="margin-left: 250px;"> <!-- sesuaikan 250px dengan lebar sidebar -->
    <!-- ISI LOWONGAN DISINI -->
</div>

    <h4 class="mb-4 fw-bold">Lowongan yang Menunggu Persetujuan</h4>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($jobs as $job)
        <div class="d-flex align-items-center justify-content-between p-3 mb-3 shadow-sm rounded bg-white">
            <div class="d-flex align-items-center">
                {{-- Logo perusahaan --}}
                <img src="{{ asset('assets/images/img7.png') }}" alt="Logo" style="height: 40px;">
                
                <div>
                    <div class="fw-bold">{{ $job->title }}</div>
                    <div class="text-muted small">{{ $job->company }}</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="btn btn-light border">Lihat detail</a>
                <form action="{{ route('lowongan.approve', $job->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Setujui</button>
                </form>
                <form action="{{ route('lowongan.reject', $job->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Tolak</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Tidak ada lowongan yang menunggu persetujuan.
        </div>
    @endforelse
@endsection
