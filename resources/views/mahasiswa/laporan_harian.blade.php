@extends('partials_mahasiswa_login.template')

@section('main')
    {{-- ganti dari 'content' ke 'main' --}}
    <div class="d-flex" style="min-height: 100vh">

        {{-- Sidebar --}}
        @include('partials_mahasiswa_login.sidebar_mahasiswa')

        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <div class="d-flex gap-2">
                <button class="btn fw-semibold" style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">
                    UPLOAD LAPORAN
                </button>

                <button class="btn btn-outline-secondary text-muted" disabled>STATUS LAPORAN</button>
                <button class="btn btn-outline-secondary text-muted" disabled>MINTA IZIN</button>
            </div>


            <div class="card shadow-sm mt-3">

                <div class="card-body">
                    <h5 class="fw-bold mb-3">Laporan Harian</h5>
                    <p class="text-muted">Tulis Apa Saja Yang Kamu Sudah Kerjakan Hari Ini</p>

                    <form action="{{ route('laporan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi pekerjaan</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"
                                placeholder="Tuliskan kegiatanmu hari ini..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 rounded-pill mt-3"
                            style="background-color: #d60000; border-color: #b50000;">Kirim Laporan</button>
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
