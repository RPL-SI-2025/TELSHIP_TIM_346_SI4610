@extends('partials_mahasiswa_login.template')

@section('main')
    <div class="d-flex" style="min-height: 100vh">

        @include('partials_mahasiswa_login.sidebar_mahasiswa')

        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <div class="d-flex gap-2">
                <a href="{{ url('/mahasiswa/laporan') }}" class="btn btn-outline-secondary text-muted"class="btn fw-semibold">
                    UPLOAD LAPORAN
                </a>

                <a class="btn fw-semibold" href="{{ url('mahasiswa/status') }}"
                    style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">STATUS LAPORAN</a>
                <a href="{{ url('/mahasiswa/izin') }}"
                    class="btn btn-outline-secondary text-muted"class="btn fw-semibold">MINTA IZIN</a>
            </div>

            <div class="card shadow-sm mt-3">

                @foreach ($laporans as $laporan)
                    <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom">
                        <div class="fw-bold text-dark">
                            {{ $laporan->jenis_laporan == 'izin' ? 'Laporan Izin' : 'Laporan Harian' }}
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="text-muted small">
                                {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d/m/Y') }}
                            </div>

                            @php
                                $badgeStyles = [
                                    'disetujui' => ['bg' => '#e9fce9', 'color' => '#28a745', 'text' => 'Disetujui'],
                                    'diproses' => ['bg' => '#e9f2ff', 'color' => '#007bff', 'text' => 'Diproses'],
                                    'ditolak' => ['bg' => '#ffe9e9', 'color' => '#dc3545', 'text' => 'Ditolak'],
                                ];
                                $status = $laporan->status;
                            @endphp

                            <span class="badge rounded-pill text-center px-3 py-2"
                                style="background-color: {{ $badgeStyles[$status]['bg'] }};
                                 color: {{ $badgeStyles[$status]['color'] }};
                                 min-width: 100px; display: inline-block;">
                                {{ $badgeStyles[$status]['text'] }}
                            </span>
                        </div>
                    </div>
                @endforeach

                {{-- Jika tidak ada laporan --}}
                @if ($laporans->isEmpty())
                    <div class="text-center text-muted py-4">
                        Belum ada laporan.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
