@extends('partials_mahasiswa_login.template')
 
@section('main')
    <style>
        body {
            background-color: white !important;
        }
 
        .dropdown-menu .dropdown-item:hover {
            background-color: #dc3545 !important;
            /* merah Bootstrap */
            color: #fff !important;
        }
    </style>
    <div class="d-flex" style="min-height: 100vh">
 
        @include('partials_mahasiswa_login.sidebar_mahasiswa')
 
        <div class="flex-grow-1">
            <!-- Banner -->
            <div class="position-relative text-white"
                style="background: linear-gradient(to right, #EC1D24, #A71318); padding-top: 8rem; padding-bottom: 2rem;">
                <h1 class="fw-bold p-4 text-white" style="color: white;">LOWONGAN MAHASISWA</h1>
                <img src="{{ asset('assets/images/ft3.svg') }}" alt="Banner" class="position-absolute end-0 top-0 h-100">
            </div>
 
            <!-- Filter and Search -->
            <div class="d-flex align-items-center gap-3 mx-4 mt-4">
                <!-- Tombol Filter -->
                <form method="GET" class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="border-radius: 8px; padding: 10px 16px;">
                            <img src="/assets/icons/vector.svg" alt="Filter" class="me-2"
                                style="width: 16px; height: 16px;">
                            Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" type="submit" name="perusahaan" value="">Semua
                                    Perusahaan</button>
                            </li>
                            @foreach ($daftarPerusahaan as $perusahaan)
                                <li>
                                    <button class="dropdown-item" type="submit" name="perusahaan"
                                        value="{{ $perusahaan }}">
                                        {{ $perusahaan }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
 
 
 
 
 
                <!-- Search Box -->
                <!-- <div class="position-relative" style="max-width: 250px; width: 100%;">
                    <input type="text" class="form-control ps-5" placeholder="Search here" style="border-radius: 8px;">
                    <img src="/assets/icons/search.svg" alt="Search"
                        class="position-absolute top-50 start-0 translate-middle-y ms-3" style="width: 16px; height: 16px;">
                </div>-->
        </div>
 
            
            <div class="mx-4 mt-4">
                <div class="row">
                    @foreach ($lowongans as $lowongan)
                        <div class="col-6 mb-4">
                            <a href="{{ route('lowongan.detail', $lowongan->id_lowongan) }}" class="text-decoration-none">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between ">
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
                </div>
            </div>
        </div>
    </div>
@endsection