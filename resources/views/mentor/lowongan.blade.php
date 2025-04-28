@extends('partials_mentor.template')

@section('main')
    <div class="d-flex" style="min-height: 100vh">

        @include('partials_mentor.sidebar_mentor')

        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <!-- Tombol Tambah Lowongan -->
            <div class="mb-4">
                <button type="button" class="btn text-white d-flex align-items-center gap-2" data-bs-toggle="modal"
                    data-bs-target="#tambahLowonganModal"
                    style="
                        background: linear-gradient(90deg, #EC1D24 0%, #A71318 100%);
                        border: none;
                        border-radius: 8px;">
                    <i class="bi bi-plus-circle"></i> TAMBAH LOWONGAN
                </button>

            </div>

            <!-- Card Lowongan -->
            @foreach ($lowongans as $lowongan)
            <a href="{{ url('/seleksi/' . $lowongan->id) }}" style="text-decoration: none; color: inherit;">
                <div class="card shadow-sm mb-3" style="border-radius: 12px; overflow: hidden;">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="overflow-hidden" style="width: 45px; height: 45px;">
                                @if (!empty($lowongan->userMentor->mitra->logo_perusahaan))
                                    <img src="{{ asset('storage/' . $lowongan->userMentor->mitra->logo_perusahaan) }}"
                                        alt="Logo Perusahaan" class="w-100 h-100 object-fit-cover">
                                @else
                                    <img src="{{ asset('app-assets/img/ICON.svg') }}" alt="Default Logo"
                                        class="w-100 h-100 object-fit-cover">
                                @endif
                            </div>
                            <div>
                                <div class="fw-bold fs-5">{{ $lowongan->nama_posisi }}</div>
                                <div class="text-muted">
                                    {{ $lowongan->userMentor->mitra->nama_perusahaan ?? 'Perusahaan tidak ditemukan' }}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            @php
                                $tanggalSekarang = \Carbon\Carbon::now();
                                $tanggalDibukaSampai = \Carbon\Carbon::parse($lowongan->dibuka_sampai);
                                $selisihHari = $tanggalSekarang->diffInDays($tanggalDibukaSampai, false);

                                $badgeStyles = [
                                    'disetujui' => ['bg' => '#e9fce9', 'color' => '#28a745', 'text' => 'Aktif'],
                                    'diproses' => ['bg' => '#e9f2ff', 'color' => '#007bff', 'text' => 'Diproses'],
                                    'ditolak' => ['bg' => '#ffe9e9', 'color' => '#dc3545', 'text' => 'Ditolak'],
                                    'menunggu' => ['bg' => '#e9f2ff', 'color' => '#007bff', 'text' => 'Menunggu'],
                                ];
                                $status = $lowongan->status;
                            @endphp

                            @if ($selisihHari > 0)
                                <div class="text-muted">{{ intval($selisihHari) }} Hari Tersisa</div>
                            @else
                                <div class="text-muted">Lowongan Ditutup</div>
                            @endif

                            <span class="badge rounded-pill text-center px-3 py-2"
                                style="background-color: {{ $badgeStyles[$status]['bg'] }}; 
                                color: {{ $badgeStyles[$status]['color'] }}; 
                                min-width: 80px; display: inline-block;">
                                {{ $badgeStyles[$status]['text'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </a>    
            @endforeach

            <!-- Jika tidak ada lowongan -->
            @if ($lowongans->isEmpty())
                <div class="text-center text-muted py-4">
                    Belum ada lowongan.
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah Lowongan -->
    <div class="modal fade" id="tambahLowonganModal" tabindex="-1" aria-labelledby="tambahLowonganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #EC1D24; color: white;">
                    <h5 class="modal-title" id="tambahLowonganModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <p class="text-muted">Lengkapi form berikut untuk menambahkan lowongan</p>

                    <form action="{{ route('mentor.lowongan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_mentor" value="{{ $usermentor->id_mentor }}">

                        <div class="mb-3">
                            <label for="nama_posisi" class="form-label">Nama Posisi</label>
                            <input type="text" class="form-control" id="nama_posisi" name="nama_posisi"
                                placeholder="Ketik disini" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lowongan" class="form-label">Tanggal Lowongan</label>
                            <input type="date" class="form-control" id="tanggal_lowongan" name="tanggal_lowongan"
                                placeholder="Ketik disini" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control" id="deskripsi_pekerjaan" name="deskripsi_pekerjaan" rows="3"
                                placeholder="Ketik disini" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_kuota" class="form-label">Jumlah Kuota</label>
                            <input type="number" class="form-control" id="jumlah_kuota" name="jumlah_kuota"
                                placeholder="Ketik disini" required>
                        </div>

                        <div class="mb-3">
                            <label for="durasi_magang" class="form-label">Durasi Magang</label>
                            <input type="text" class="form-control" id="durasi_magang" name="durasi_magang"
                                placeholder="Ketik disini" required>
                        </div>

                        <div class="mb-3">
                            <label for="persyaratan" class="form-label">Persyaratan</label>
                            <textarea class="form-control" id="persyaratan" name="persyaratan" rows="3" placeholder="Ketik disini" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn" style="background-color: #EC1D24; color: white;">Simpan
                                & Publikasikan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Berhasil -->
    <div class="modal fade" id="modalBerhasil" tabindex="-1" aria-labelledby="modalBerhasilLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body text-center p-5">
                    <img src="{{ asset('assets/images/OBJECTS.svg') }}" alt="Sukses"
                        style="width: 200px; max-width: 100%; margin-bottom: 20px;">
 
                    <h4 class="fw-bold mb-3">Lowongan Sedang Ditinjau</h4>
 
                    <p class="text-secondary mb-4">
                        Lowongan magang sedang ditinjau oleh admin untuk disetujui
                    </p>
 
                    <button type="button" class="btn w-100 py-3 rounded-pill fw-bold"
                        style="background-color: #EC1D24; color: white;" data-bs-dismiss="modal">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
 
    <script>
        // Cek jika ada pesan sukses dari controller
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                var modalBerhasil = new bootstrap.Modal(document.getElementById('modalBerhasil'));
                modalBerhasil.show();
            @endif
        });
    </script>    

@endsection