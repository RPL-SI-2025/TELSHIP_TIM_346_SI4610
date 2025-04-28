@extends('partials_mentor.template')
 
@section('main')
    <div class="d-flex" style="min-height: 100vh">
 
        {{-- Sidebar --}}
        @include('partials_mentor.sidebar_mentor')
 
        <div style="flex: 1; margin-top: 80px;">
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success" style="margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
 
            @foreach ($lamarans as $lamaran)
                <div
                    style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 1rem 2rem; border-radius: 10px; border: 1px solid #fff5f5; margin-bottom: 1rem;">
                    <!-- Pelamar Info -->
                    <div style="display: flex; align-items: center;">
                        <img src="{{ $lamaran->mahasiswa && $lamaran->mahasiswa->foto_profile ? Storage::url('fotos/' . $lamaran->mahasiswa->foto_profile) : asset('images/default-profile.png') }}"
                            alt="Foto"
                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 1rem;"
                            onerror="this.src='{{ asset('app-assets/img/avatars/1.png') }}'">
                        <div>
                            <strong style="color: #000000;">
                                {{ $lamaran->mahasiswa ? $lamaran->mahasiswa->nama_lengkap : 'Nama Tidak Tersedia' }}
                            </strong><br>
                            <span style="font-size: 14px; color: ##979797;">
                                {{ $lamaran->mahasiswa ? $lamaran->mahasiswa->jurusan : 'Jurusan Tidak Tersedia' }}
                            </span>
 
                        </div>
                        <a href="#"
                            style="margin-left: 1rem; background-color: #DBDBDB33; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-size: 13px; color: #686868; border: 1px solid #686868;">Lihat
                            Profil</a>
                    </div>
 
                    <!-- Aksi -->
                    <div>
                        <form method="POST" action="{{ route('seleksi.terima', $lamaran->id_lamaran) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                style="background-color: #e7ffea; color: #2ae330 ; border: 1px solid #2ae330; padding: 8px 16px; border-radius: 6px; margin-right: 8px;">Terima</button>
                        </form>
                        <form method="POST" action="{{ route('seleksi.tolak', $lamaran->id_lamaran) }}"
                            style="display:inline;">
                            @csrf
                            <button type="submit"
                                style="background-color: #fff5f5; color: #b30000; border: 1px solid #b30000; padding: 8px 16px; border-radius: 6px;">Tolak</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection