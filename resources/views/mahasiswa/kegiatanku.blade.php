@extends('partials_mahasiswa_login.template')
 
@section('main')
    <div class="d-flex" style="min-height: 100vh">
 
        {{-- Sidebar --}}
        @include('partials_mahasiswa_login.sidebar_mahasiswa')
 
        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <div class="d-flex gap-2 mb-4">
                <a href="{{ url('/mahasiswa/status/lamaran') }}" class="btn btn-outline-secondary text-muted">STATUS
                    PENDAFTARAN</a>
                <a class="btn fw-semibold" href="{{ url('/mahasiswa/kegiatanku') }}"
                    style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">KEGIATANKU</a>
            </div>
 
 
            @php
                $lamaranLolos = $lamaran->where('status', 'lolos');
            @endphp
 
            @if ($lamaranLolos->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/images/belumada.svg') }}" alt="Belum Ada Lamaran" class="img-fluid"
                        style="max-width: 250px;">
                    <h3 class="mt-4">Belum Ada Lamaran Aktif</h3>
                    <p>Belum Ada Kegiatan Aktif</p>
                    <a href="{{ url('/mahasiswa/status/lamaran') }}" class="btn"
                        style="background-color: #EC1D24; border-radius: 25px; color: white; padding: 10px 20px; text-align: center;">
                        Check Status Lowongan Magang
                    </a>
                </div>
            @else
                @foreach ($lamaranLolos as $lamar)
                    <div class="card shadow-sm mb-3" style="border-radius: 12px; overflow: hidden;">
                        <div class="d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="overflow-hidden" style="width: 45px; height: 45px;">
                                    @php
                                        $mitraLogo = optional($lamar->lowongan->userMentor->mitra)->logo_perusahaan;
                                        $logoSrc = $mitraLogo
                                            ? asset('storage/' . $mitraLogo)
                                            : asset('images/Logo Oplib.png');
                                    @endphp
                                    <img src="{{ $logoSrc }}" alt="Logo Perusahaan"
                                        class="w-100 h-100 object-fit-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('images/Logo Oplib.png') }}';">
                                </div>
                                <div>
                                    <div class="fw-bold fs-5">{{ $lamar->lowongan->nama_posisi ?? '-' }}</div>
                                    <div class="text-muted">
                                        {{ $lamar->lowongan->userMentor->mitra->nama_perusahaan ?? 'Perusahaan tidak ditemukan' }}
                                    </div>
                                </div>
                            </div>
 
                            <div class="d-flex align-items-center gap-3">
                                @php
                                    $tanggalSekarang = \Carbon\Carbon::now();
                                    $tanggalDibukaSampai = \Carbon\Carbon::parse($lamar->lowongan->dibuka_sampai);
                                    $selisihHari = $tanggalSekarang->diffInDays($tanggalDibukaSampai, false);
                                @endphp
 
                                <span class="badge rounded-pill text-center px-3 py-2"
                                    style="background-color: #C42AE3; color: #FFFFFF; min-width: 80px; display: inline-block;">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
 
        </div>
    </div>
 
 
@endsection