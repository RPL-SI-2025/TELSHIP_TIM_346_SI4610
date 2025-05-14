@extends('partials_admin.template')

@section('title', 'Approval Lowongan')

@section('main')
<div class="container py-4 mt-5">
    <h4 class="mb-4 fw-bold">Lowongan yang Menunggu Persetujuan</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($lowongans as $lowongan)
        <div 
            class="lowongan-card d-flex align-items-center justify-content-between p-3 mb-3 shadow-sm rounded bg-white"
            data-bs-toggle="modal"
            data-bs-target="#detailModal"
            onclick="showDetail(
                '{{ $lowongan->id_lowongan }}',
                '{{ $lowongan->nama_posisi ?? '-' }}',
                '{{ $lowongan->userMentor->mitra->nama_perusahaan ?? 'Nama Perusahaan' }}',
                `{{ $lowongan->deskripsi_pekerjaan ?? '-' }}`,
                '{{ $lowongan->jumlah_kuota ?? '-' }}',
                '{{ $lowongan->durasi_magang ?? '-' }}',
                `{{ $lowongan->persyaratan ?? '-' }}`,
                '{{ $lowongan->dibuka_sampai ?? '-' }}'
            )"
            style="cursor: pointer;"
        >
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
                    <button id="btn-approve" class="btn" onclick="event.stopPropagation();" style="background-color: #e7ffea; color: #2ae330 ; border: 1px solid #2ae330; padding: 8px 16px; border-radius: 6px; margin-right: 8px;">
                    Setujui</button>
                </form>
                <form action="{{ route('lowongan.reject', $lowongan->id_lowongan) }}" method="POST" class="d-inline">
                    @csrf
                    <button id="btn-reject" class="btn btn-danger" onclick="event.stopPropagation();" style="background-color: #fff5f5; color: #b30000; border: 1px solid #b30000; padding: 8px 16px; border-radius: 6px;">
                    Tolak</button>
                </form>
            </div>

        </div>
    @empty
        <div class="alert alert-info">
            Tidak ada lowongan yang menunggu persetujuan.
        </div>
    @endforelse
</div>

{{-- Modal --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Lowongan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <h6 id="modalNamaPosisi"></h6>
        <p class="text-muted" id="modalNamaPerusahaan"></p>

        <hr>
        <strong>Deskripsi Pekerjaan:</strong>
        <p id="modalDeskripsi"></p>

        <strong>Jumlah Kuota:</strong>
        <p id="modalKuota"></p>

        <strong>Durasi Magang:</strong>
        <p id="modalDurasi"></p>

        <strong>Persyaratan:</strong>
        <p id="modalPersyaratan"></p>

        <strong>Dibuka Sampai:</strong>
        <p id="modalDibukaSampai"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script>
    function showDetail(id, namaPosisi, namaPerusahaan, deskripsi, kuota, durasi, persyaratan, dibukaSampai) {
        document.getElementById('modalNamaPosisi').textContent = namaPosisi;
        document.getElementById('modalNamaPerusahaan').textContent = namaPerusahaan;
        document.getElementById('modalDeskripsi').textContent = deskripsi;
        document.getElementById('modalKuota').textContent = kuota;
        document.getElementById('modalDurasi').textContent = durasi;
        document.getElementById('modalPersyaratan').textContent = persyaratan;
        document.getElementById('modalDibukaSampai').textContent = dibukaSampai;
    }
</script>

@endsection
