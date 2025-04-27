@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Pelamar</h2>

    <div class="card p-4">
        <div class="d-flex align-items-center">
            <img src="{{ asset('storage/foto/' . $pelamar->foto) }}" alt="Foto Profil" width="100" class="rounded-circle me-4">
            <div>
                <h4>{{ $pelamar->nama }}</h4>
                <p>Jurusan: {{ $pelamar->jurusan }}</p>
                <p>Email: {{ $pelamar->email }}</p>
            </div>
        </div>

        <hr>

        @if($pelamar->cv)
            <p><strong>CV:</strong> <a href="{{ asset('storage/cv/' . $pelamar->cv) }}" target="_blank">Download CV</a></p>
        @else
            <p><em>CV belum tersedia.</em></p>
        @endif
    </div>
</div>
@endsection
