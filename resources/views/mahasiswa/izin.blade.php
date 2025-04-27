@extends('partials_mahasiswa_login.template')

@section('main')
    {{-- ganti dari 'content' ke 'main' --}}
    <div class="d-flex" style="min-height: 100vh">

        {{-- Sidebar --}}
        @include('partials_mahasiswa_login.sidebar_mahasiswa')

        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <div class="d-flex gap-2">
                <a href="{{ url('/mahasiswa/laporan') }}" class="btn btn-outline-secondary text-muted"class="btn fw-semibold">
                    UPLOAD LAPORAN
                </a>
                <a href="{{ url('/mahasiswa/status') }}"
                    class="btn btn-outline-secondary text-muted"class="btn fw-semibold">STATUS LAPORAN</a>
                <a class="btn fw-semibold" href="{{ url('mahasiswa/izin') }}"
                    style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">MINTA IZIN</a>
            </div>


            <div class="card shadow-sm mt-3">

                <div class="card-body">Kirim Izin Ke Mentor</h5>
                    <p class="text-muted">Tuliskan mengapa kamu izin hari ini</p>

                    <form action="{{ route('izin.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Alasan Perizinan</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"
                                placeholder="Tuliskan kegiatanmu hari ini..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 rounded-pill mt-3"
                            style="background-color: #EC1D24;">Kirim Izin</button>
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
