@extends('partials_admin.template')
 
@section('title', 'Approval Lowongan')
 
@section('main')
    <div class="container py-4 mt-5">
        <h4 class="mb-4 fw-bold">Lowongan yang Menunggu Persetujuan</h4>
 
        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
 
        @forelse($lowongans as $lowongan)
            <div class="d-flex align-items-center justify-content-between p-3 mb-3 shadow-sm rounded bg-white">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/images/img7.png') }}" alt="Logo" style="height: 40px;">
 
                    <div>
                        <div class="fw-bold">{{ $lowongan->nama_posisi ?? '-' }}</div>
 
                        <div class="text-muted small">
                            {{ $lowongan->userMentor->mitra->nama_perusahaan ?? 'Nama Perusahaan' }}
                        </div>
                    </div>
                </div>
 
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route('lowongan.approve', $lowongan->id_lowongan) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success">Setujui</button>
                    </form>
                    <form action="{{ route('lowongan.reject', $lowongan->id_lowongan) }}" method="POST" class="d-inline">
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
    </div>
@endsection