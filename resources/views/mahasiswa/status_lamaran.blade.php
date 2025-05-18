@extends('partials_mahasiswa_login.template')
 
@section('main')
    <div class="d-flex" style="min-height: 100vh">
 
        {{-- Sidebar --}}
        @include('partials_mahasiswa_login.sidebar_mahasiswa')
 
        {{-- Konten Utama --}}
        <div class="flex-grow-1 p-4" style="margin-top: 60px;">
            <div class="d-flex gap-2 mb-4">
                <a class="btn fw-semibold" href="{{ url('/mahasiswa/status/lamaran') }}"
                    style="color: #dc3545; border: 2px solid #dc3545; pointer-events: none;">STATUS PENDAFTARAN</a>
                <a href="{{ url('/mahasiswa/kegiatanku') }}" class="btn btn-outline-secondary text-muted">KEGIATANKU</a>
            </div>
 
            @if ($lamaran->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/images/belumada.svg') }}" alt="Belum Ada Lamaran" class="img-fluid"
                        style="max-width: 250px;">
                    <h3 class="mt-4">Belum Ada Lamaran</h3>
                    <p>Belum ada pendaftaran program magang internal TELSHIP</p>
                    <a href="{{ url('/mahasiswa/lowongan') }}" class="btn"
                        style="background-color: #EC1D24; border-radius: 25px; color: white; padding: 10px 20px; text-align: center;">
                        Cari Lowongan Magang
                    </a>
                </div>
            @else
                @foreach ($lamaran as $lamar)
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
 
                                    $badgeStyles = [
                                        'lolos' => ['bg' => '#e9fce9', 'color' => '#28a745', 'text' => 'Lolos'],
                                        'diproses' => ['bg' => '#e9f2ff', 'color' => '#007bff', 'text' => 'Diproses'],
                                        'ditolak' => ['bg' => '#ffe9e9', 'color' => '#dc3545', 'text' => 'Ditolak'],
                                    ];
                                    $status = $lamar->status ?? 'diproses';
                                @endphp
 
                                <div class="text-muted">
                                    {{ $selisihHari > 0 ? intval($selisihHari) . ' Hari Tersisa' : 'Lamaran Ditutup' }}
                                </div>
 
                                <span class="badge rounded-pill text-center px-3 py-2"
                                    style="background-color: {{ $badgeStyles[$status]['bg'] ?? '#e9f2ff' }};
                                    color: {{ $badgeStyles[$status]['color'] ?? '#007bff' }};
                                    min-width: 80px; display: inline-block;">
                                    {{ $badgeStyles[$status]['text'] ?? ucfirst($status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @if ($lamaranLolos)
        <div class="modal fade" id="modalBerhasil" tabindex="-1" aria-labelledby="modalBerhasilLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">
                    <div class="modal-body text-center p-5">
                        <img src="{{ asset('assets/images/OBJECTS.svg') }}" alt="Sukses"
                            style="width: 200px; max-width: 100%; margin-bottom: 20px;">
                        <h4 class="fw-bold mb-3">Selamat kamu lolos!</h4>
                        <p class="text-secondary mb-4">
                            Sebagai <strong>{{ $lamaranLolos->lowongan->nama_posisi }}</strong> di
                            <strong>{{ $lamaranLolos->lowongan->userMentor->mitra->nama_perusahaan }}</strong>.
                            Pelajari dulu tawaran ini sebelum merespon ya.
                        </p>
 
                        <form id="formResponLamaran" method="POST" data-id="{{ $lamaranLolos->id_lamaran }}">
                            @csrf
 
                            <button type="button" class="btn btn-outline-danger"
                                style="border-radius: 25px; padding: 10px 20px;" data-aksi="tolak">
                                Tolak
                            </button>
 
                            <button type="button" class="btn btn-danger"
                                style="background-color: #EC1D24; border-radius: 25px; color: white; padding: 10px 20px; text-align: center;"
                                data-aksi="terima">
                                Ambil Tawaran
                            </button>
                        </form>
 
 
                    </div>
                </div>
            </div>
        </div>
    @endif
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('formResponLamaran');
            const idLamaran = form.dataset.id;
 
            if (form) {
                form.querySelectorAll('button[data-aksi]').forEach(button => {
                    button.addEventListener('click', function() {
                        const aksi = this.dataset.aksi;
                        const url = aksi === 'tolak' ?
                            `/mahasiswa/lamaran/${idLamaran}/tolak` :
                            `/mahasiswa/lamaran/${idLamaran}/terima`;
 
                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                                    'Accept': 'application/json',
                                },
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    const modalElement = document.getElementById(
                                        'modalBerhasil');
                                    const modal = bootstrap.Modal.getInstance(modalElement);
                                    modal.hide();
 
                                    alert(data.message);
                                    location.reload();
                                }
                            })
                            .catch(err => {
                                console.error('Gagal mengirim respon:', err);
                            });
                    });
                });
            }
 
            // Tampilkan modal jika belum direspon
            @if ($lamaranLolos && !$lamaranLolos->sudah_direspon)
                const modalElement = document.getElementById('modalBerhasil');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            @endif
        });
    </script>
 
 
@endsection