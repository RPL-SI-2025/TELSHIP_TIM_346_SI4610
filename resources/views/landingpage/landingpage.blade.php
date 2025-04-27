@extends('partials_mahasiswa.template')

@section('page_style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .hero-container {
            max-width: 1100px;
            margin: auto;
            text-align: center;
            padding: 50px 20px;
        }

        .badge-custom {
            display: inline-block;
            background-color: white;
            border: 2px solid #ffffff;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hero-title {
            font-size: 32px;
            font-weight: bold;
            line-height: 1.3;
            color: #000;
        }

        .hero-subtitle {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .button-group {
            margin-top: 20px;
        }

        .btn-primary-custom {
            background-color: #d60000;
            border-color: #b50000;
            padding: 12px 25px;
            color: white;
            font-weight: bold;
            border-radius: 25px;
            font-size: 16px;
            margin-right: 10px;
        }

        .btn-secondary-custom {
            background-color: white;
            color: black;
            border: 2px solid #000;
            padding: 12px 25px;
            font-weight: bold;
            border-radius: 25px;
            font-size: 16px;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 40px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .gallery-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .gallery-left,
        .gallery-right {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .gallery-center {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .gallery-center img {
            width: 100%;
            max-height: 380px;
        }

        .partners-container {
            text-align: center;
            margin: 50px auto;
            max-width: 900px;
        }

        .partners-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .partners-logos {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .partners-logos img {
            height: 100%;
            object-fit: contain;
        }

        .features-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 900px;
            margin: 40px auto;
        }

        .feature-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.05);
            text-align: left;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .feature-icon {
            font-size: 24px;
        }

        .feature-text h4 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .feature-text p {
            font-size: 14px;
            color: #555;
            margin: 0;
        }

        .containerz {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        p.description {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
        }

        .card-left {
            text-align: left;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .card p {
            font-size: 14px;
            color: #777;
            margin: 3px 0;
        }

        .quota {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #999;
        }

        .quota img {
            width: 16px;
            margin-right: 5px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kemahasiswaan {
            background: #fce4ec;
            color: #c2185b;
            border: 1px solid #c2185b;
        }

        .language-center {
            background: #e3f2fd;
            color: #1565c0;
            border: 1px solid #1565c0;
        }

        .open-library {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #2e7d32;
        }

        .lihat-semua-container {
            text-align: center;
            margin-top: 20px;
            /* Jarak dari elemen sebelumnya */
            margin-bottom: 50px;
            /* Jarak ke footer */
        }

        .btn-lihat-semua {
            padding: 8px 24px;
            border-radius: 999px;
            /* Biar jadi oval */
            border: 1px solid #ffffff;
            /* Warna abu-abu muda */
            background: white;
            font-size: 16px;
            font-weight: 600;
            color: black;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-lihat-semua:hover {
            background: #f9f9f9;
            /* Efek hover sedikit lebih gelap */
        }
    </style>
@endsection

@section('main')
    <main class="main-content" style="background-color: #fff;">
        <div class="hero-container">
            <span class="badge-custom">Sedang Berlangsung 🔥 Batch 2</span>
            <h1 class="hero-title">Platform Resmi Magang <br> Internal Telkom University</h1>
            <p class="hero-subtitle">
                Telship adalah platform resmi magang internal Telkom University <br>
                untuk pendaftaran dan pemantauan magang mahasiswa.
            </p>

            <div class="button-group">
                <!-- Button untuk Jelajahi Program Magang -->
                <a href="{{ url('/mahasiswa/lowongan') }}" class="btn"
                    style="background-color: #d60000; border-color: #b50000; color: white; text-decoration: none;">
                    Jelajahi Program Magang
                </a>

                <!-- Button untuk Daftar Sekarang -->
                <a href="{{ url('/mahasiswa/profile') }}" class="btn btn-secondary-custom"
                    style="background-color: #6c757d; color: white; text-decoration: none;">
                    Daftar Sekarang
                </a>
            </div>

            <div class="gallery-container">
                <!-- Kolom Kiri -->
                <div class="gallery-left">
                    <img src="{{ asset('assets/images/img1.png') }}" alt="Image 1">
                    <img src="{{ asset('assets/images/img2.png') }}" alt="Image 2">
                </div>

                <!-- Kolom Tengah -->
                <div class="gallery-center">
                    <img src="{{ asset('assets/images/img3.png') }}" alt="Image Center">
                </div>

                <!-- Kolom Kanan -->
                <div class="gallery-right">
                    <img src="{{ asset('assets/images/img4.png') }}" alt="Image 3">
                    <img src="{{ asset('assets/images/img5.png') }}" alt="Image 4">
                </div>

            </div>
        </div>

        <div class="partners-container">
            <h2 class="partners-title">Bekerjasama Dengan</h2>
            <div class="partners-logos">
                <img src="{{ asset('assets/images/img6.png') }}" alt="Partner 1">
                <img src="{{ asset('assets/images/img7.png') }}" alt="Partner 2">
                <img src="{{ asset('assets/images/img8.png') }}" alt="Partner 3">
                <img src="{{ asset('assets/images/img9.png') }}" alt="Partner 4">
                <img src="{{ asset('assets/images/img10.png') }}" alt="Partner 5">
            </div>
        </div>

        <!-- BAGIAN FITUR -->
        <div class="features-container">
            <div class="feature-card">
                <span class="feature-icon">📦</span>
                <div class="feature-text">
                    <h4>Etalase Magang</h4>
                    <p>Jelajahi Beragam Program Magang Sesuai Jurusan dan Minatmu.</p>
                </div>
            </div>

            <div class="feature-card">
                <span class="feature-icon">📊</span>
                <div class="feature-text">
                    <h4>Tracking Status</h4>
                    <p>Pantau Progres Pendaftaran & Laporanmu Secara Real-Time.</p>
                </div>
            </div>

            <div class="feature-card">
                <span class="feature-icon">⏰</span>
                <div class="feature-text">
                    <h4>Absensi Online</h4>
                    <p>Praktis! Check-In dan Check-Out Langsung Dari Platform.</p>
                </div>
            </div>
        </div>


        <div class="containerz">
            <h2>Pilihan Program Magang Internal Yang Tersedia</h2>
            <p class="description">
                Temukan Berbagai Program Magang Yang Dirancang Untuk Mengasah Keterampilan Dan Memperluas Wawasanmu,
                Didampingi Langsung Oleh Dosen Ahli Di Bidangnya.
            </p>

            @foreach ($lowongans as $lowongan)
                <div class="col-6 mb-4">
                    <a href="{{ route('lowongan.detail', $lowongan->id_lowongan) }}" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title fw-bold">{{ $lowongan->nama_posisi }}</h5>
                                    <span class="badge"
                                        style="background-color: #e1bee7; color: #424040; border: 2px solid #8e24aa; border-radius: 15px; padding: 5px 10px; display: inline-block; text-align: center; line-height: 20px;">
                                        {{ $lowongan->userMentor->mitra->nama_perusahaan }}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <small style="color: #6c757d;">Dibuka Sampai:
                                        {{ \Carbon\Carbon::parse($lowongan->dibuka_sampai)->format('d M Y') }}</small>
                                </div>
                                <p class="card-text" style="font-size: 14px; color: #000000;">
                                    {{ $lowongan->deskripsi_pekerjaan }}
                                </p>
                                <div class="mt-3">
                                    <span style="font-size: 14px; color: #6c757d;">
                                        <img src="{{ asset('assets/icons/user.svg') }}" alt="icon"> Kuota:
                                        {{ $lowongan->jumlah_kuota }} Orang
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach


            <!-- Tombol Lihat Semua -->
            <div class="lihat-semua-container">
                <a href="{{ url('mahasiswa/lowongan') }}" class="btn btn-light btn-lihat-semua">Lihat Semua</a>
            </div>


        </div>
    </main>
@endsection

@section('page_script')
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
@endsection
