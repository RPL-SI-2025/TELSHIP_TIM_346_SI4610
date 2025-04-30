@extends('partials_mahasiswa_login.template')

@section('main')
    <style>
        body {
            background-color: white !important;
        }

        .info-card {
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .check-icon {
            color: #2ecc71;
            background-color: #eafaf1;
            border-radius: 50%;
            padding: 3px;
            margin-right: 10px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h4 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .info-detail {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .info-detail h5 {
            font-weight: 600;
            margin-bottom: 10px;
        }
    </style>
    <div class="d-flex" style="min-height: 100vh">

        @include('partials_mahasiswa_login.sidebar_mahasiswa')

        <div class="flex-grow-1">
            <!-- Banner -->
            <div class="position-relative text-white"
                style="background: linear-gradient(to right, #EC1D24, #A71318); padding-top: 6rem; padding-bottom: 2rem;">

                <!-- Tombol Back -->
                <div class="px-4 mb-2">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-outline-light rounded-pill d-inline-flex align-items-center px-3 py-1"
                        style="border: 2px solid white;">
                        <img src="{{ asset('assets/icons/left_back.svg') }}" class="me-1"> Back
                    </a>
                </div>
                <div class="px-4">
                    <h1 class="fw-bold text-white mb-1">{{ $lowongans->nama_posisi }}</h1>

                </div>
                <div class="position-absolute end-0 bottom-0 mb-4 me-4" style="z-index: 5;">
                    <button id="btn-lamar" class="btn rounded-pill fw-bold px-4 py-3"
                        style="background-color: #ffffff; color: #000000; box-shadow: 0 2px 5px rgba(0,0,0,0.2);"
                        data-id-lowongan="{{ $lowongans->id_lowongan }}">
                        Lamar Sekarang
                    </button>
                </div>

                <img src="{{ asset('assets/images/ft3.svg') }}" alt="Banner" class="position-absolute end-0 top-0 h-100"
                    style="z-index: 1;">
            </div>

            <div class="modal fade" id="modalBerhasil" tabindex="-1" aria-labelledby="modalBerhasilLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0">
                        <div class="modal-body text-center p-5">
                            <img src="{{ asset('assets/images/OBJECTS.svg') }}" alt="Sukses"
                                style="width: 200px; max-width: 100%; margin-bottom: 20px;">

                            <h4 class="fw-bold mb-3">Lamaran Kamu Berhasil Dikirim</h4>

                            <p class="text-secondary mb-4">
                                Kami Sudah Menerima Lamaranmu, Pantau Statusnya Di Halaman Status Lamaran. Semoga Sukses!
                            </p>

                            <button type="button" class="btn w-100 py-3 rounded-pill fw-bold"
                                style="background-color: #EC1D24; color: white;" data-bs-dismiss="modal">
                                Kembali
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            


            <!-- Konten Informasi Kegiatan -->
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold">Informasi Kegiatan</h2>
                        <p class="text-secondary">Bangun Dan Optimalkan Aplikasi Perangkat Lunak Dengan Prinsip Clean Code,
                            Didukung Oleh Dosen Teknologi Informasi.</p>
                    </div>
                    <div class="text-end">
                        @if (!empty($lowongans->userMentor->mitra->logo_perusahaan))
                            <img src="{{ asset('storage/' . $lowongans->userMentor->mitra->logo_perusahaan) }}"
                                alt="Logo Perusahaan" style="width: 182px; height: 182px; object-fit: contain;">
                        @else
                            <img src="{{ asset('app-assets/img/ICON.svg') }}" alt="Default Logo"
                                style="width: 182px; height: 182px; object-fit: contain;">
                        @endif
                    </div>


                </div>
                <div class="info-card mb-4">
                    <div class="d-flex align-items-center">
                        <span class="check-icon"><i class="fas fa-check"></i></span>
                        <div>
                            <h5 class="mb-1">Kegiatan Ini Bersertifikat Kampus</h5>
                            <p class="text-secondary mb-0">Konversi SKS dan kualitas kegiatan dijamin oleh tim Kemahasiswaan
                                Telkom University</p>
                        </div>
                    </div>
                </div>

                <!-- Rincian Kegiatan -->
                <div class="info-section">
                    <h4>Rincian Kegiatan</h4>
                    <div class="info-detail">
                        <h5>{{ $lowongans->nama_posisi }}</h5>
                        <p>{{ $lowongans->deskripsi_pekerjaan }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p><strong>Dibuka sampai:</strong>
                                    {{ \Carbon\Carbon::parse($lowongans->dibuka_sampai)->format('d M Y') }}</p>
                                <p><strong>Kuota:</strong> {{ $lowongans->jumlah_kuota }} Orang</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Durasi:</strong> {{ $lowongans->durasi_magang ?? 'Tidak ditentukan' }}</p>
                                <p><strong>Status:</strong> <span class="badge bg-success">{{ $lowongans->status }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h4>Tentang Perusahaan</h4>
                    <div class="info-detail">
                        <h5>{{ $lowongans->userMentor->mitra->nama_perusahaan }}</h5>
                        <p>{{ $lowongans->userMentor->mitra->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <p><strong>Alamat:</strong> {{ $lowongans->userMentor->mitra->alamat ?? 'Tidak tersedia' }}
                                </p>
                                <p><strong>Email:</strong> {{ $lowongans->userMentor->mitra->email ?? 'Tidak tersedia' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Telepon:</strong>
                                    {{ $lowongans->userMentor->mitra->telepon ?? 'Tidak tersedia' }}</p>
                                <p><strong>Website:</strong>
                                    @if (!empty($lowongans->userMentor->mitra->link_website))
                                        <a href="{{ $lowongans->userMentor->mitra->link_website }}" target="_blank">
                                            {{ $lowongans->userMentor->mitra->link_website }}
                                        </a>
                                    @else
                                        Tidak tersedia
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#btn-lamar').on('click', function(e) {
                e.preventDefault();

                let idLowongan = $(this).data('id-lowongan');

                $.ajax({
                    url: "{{ route('lamaran.store') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_lowongan: idLowongan
                    },
                    success: function(res) {
                        console.log('Sukses:', res);
                        $('#modalBerhasil').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Gagal:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Melamar',
                            text: xhr.responseJSON?.message ||
                                'Kamu sudah melamar untuk lowongan ini.',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }

                });
            });
        });
    </script>
@endsection
