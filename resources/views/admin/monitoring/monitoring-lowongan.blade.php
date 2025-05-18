@extends('partials_admin.template')

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
        <a id="monitoring-mahasiswa" href="{{ route('monitoring.mahasiswa') }}" class="btn btn-light border fw-bold text-muted">MAHASISWA</a>
        <a id="monitoring-lowongan" href="{{ route('monitoring.lowongan') }}" class="btn btn-outline-danger fw-bold">LOWONGAN</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Perusahaan</th>
                    <th>Mentor</th>
                    <th>Nama Posisi</th>
                    <th>Tenggat</th>
                    <th>Kuota</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($lowongans as $lowongan)
                @if(strtolower($lowongan->status) == 'disetujui')
                    @php
                        $tanggalSekarang = \Carbon\Carbon::now();
                        $tanggalDibukaSampai = \Carbon\Carbon::parse($lowongan->dibuka_sampai);
                        $selisihHari = $tanggalSekarang->diffInDays($tanggalDibukaSampai, false);

                        if ($selisihHari >= 0) {
                            // Masih dalam tenggat
                            $statusText = 'Aktif';
                            $badgeClass = 'bg-success';
                        } else {
                            // Sudah lewat tenggat
                            $statusText = 'Non Aktif';
                            $badgeClass = 'bg-danger';
                        }
                    @endphp
                    <tr>
                        <td>{{ $lowongan->userMentor->mitra->nama_perusahaan }}</td>
                        <td>{{ $lowongan->userMentor->nama_lengkap }}</td>
                        <td>{{ $lowongan->nama_posisi }}</td>
                        <td>{{ $lowongan->dibuka_sampai }}</td>
                        <td>{{ $lowongan->jumlah_kuota }}</td>
                        <td>
                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
