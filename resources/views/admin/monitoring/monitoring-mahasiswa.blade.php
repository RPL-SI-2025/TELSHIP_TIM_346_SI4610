@extends('partials_admin.template')
<style>
    .badge-selesai {
        color: #47d6aa;
        border: 2px solid #47d6aa;
        padding: 0.3em 0.5em;
        border-radius: 0.5rem;
        font-weight: 300;
        background-color: transparent;
    }
 
    .badge-berlangsung {
        color: #f29422;
        border: 2px solid #f29422;
        padding: 0.3em 0.5em;
        border-radius: 0.5rem;
        font-weight: 300;
        background-color: transparent;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
 
@section('main')
    <div class="container py-4">
        <div class="row g-3 mb-3 mt-3">
            <div class="col-md-4">
                <div class="card border rounded-4 py-3 px-4 shadow-sm h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: rgba(236, 29, 36, 0.1);">
                            <img src="{{ asset('assets/icons/star.svg') }}" alt="icon" width="22">
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $total_mahasiswa }}</h4>
                            <p class="text-muted mb-0">Peserta Magang</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border rounded-4 py-3 px-4 shadow-sm h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: rgba(236, 29, 36, 0.1);">
                            <img src="{{ asset('assets/icons/star.svg') }}" alt="icon" width="22">
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $lowongan_aktif }}</h4>
                            <p class="text-muted mb-0">Lowongan Magang Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border rounded-4 py-3 px-4 shadow-sm h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px; background-color: rgba(236, 29, 36, 0.1);">
                            <img src="{{ asset('assets/icons/star.svg') }}" alt="icon" width="22">
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $mahasiswa_selesai }}</h4>
                            <p class="text-muted mb-0">Peserta Telah Lulus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="d-flex gap-2 mb-3">
            <a href="{{ route('monitoring.mahasiswa') }}" class="btn btn-outline-danger fw-bold">MAHASISWA</a>
            <a href="{{ route('monitoring.lowongan') }}" class="btn btn-light border fw-bold text-muted">LOWONGAN</a>
        </div>
 
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Perusahaan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama_lengkap }}</td>
                            <td>{{ $mahasiswa->jurusan }}</td>
                            <td>{{ $mahasiswa->no_hp }}</td>
                            <td>{{ $mahasiswa->lamaran->first()?->lowongan?->userMentor?->mitra?->nama_perusahaan ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $lamaran = $mahasiswa->lamaran->firstWhere('status', 'lolos');
                                    $isSedangMagang = false;
                                    if ($lamaran) {
                                        $isSedangMagang = \Carbon\Carbon::parse($lamaran->updated_at)->gte(
                                            \Carbon\Carbon::now()->subMonths(3),
                                        );
                                    }
                                @endphp
 
                                @if ($lamaran)
                                    @if ($isSedangMagang)
                                        <span class="badge-berlangsung">Berlangsung</span>
                                    @else
                                        <span class="badge-selesai">Selesai</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection