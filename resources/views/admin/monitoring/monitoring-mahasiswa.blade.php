@extends('partials_admin.template')

@section('main')
<div class="container py-4">
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm" style="height: 100%;">
                <div class="card-body py-4">
                    <i class="bi bi-people-fill text-danger" style="font-size: 1.5rem;"></i>
                    <h4 class="mt-3 fw-bold">121</h4>
                    <p class="text-muted mb-0">Peserta Magang</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm" style="height: 100%;">
                <div class="card-body py-4">
                    <i class="bi bi-people-fill text-danger" style="font-size: 1.5rem;"></i>
                    <h4 class="mt-3 fw-bold">12</h4>
                    <p class="text-muted mb-0">Lowongan Magang Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm" style="height: 100%;">
                <div class="card-body py-4">
                    <i class="bi bi-people-fill text-danger" style="font-size: 1.5rem;"></i>
                    <h4 class="mt-3 fw-bold">10</h4>
                    <p class="text-muted mb-0">Peserta Telah Lulus</p>
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
                @foreach($dataMahasiswa as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa['nim'] }}</td>
                    <td>{{ $mahasiswa['nama'] }}</td>
                    <td>{{ $mahasiswa['jurusan'] }}</td>
                    <td>{{ $mahasiswa['no_hp'] }}</td>
                    <td>{{ $mahasiswa['perusahaan'] }}</td>
                    <td>
                        @if($mahasiswa['status'] == 'Selesai')
                            <span class="badge bg-success">{{ $mahasiswa['status'] }}</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $mahasiswa['status'] }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
