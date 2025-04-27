@extends('layouts.app')

@section('content')
<div class="container">
<div class="mb-4">
    <a href="{{ route('lowongan.create') }}" class="btn btn-danger">+ TAMBAH LOWONGAN</a>
</div>


    @foreach($lowongans as $lowongan)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/Logo Oplib.png') }}" alt="Logo" style="width: 50px; height: 50px;" class="me-3">
                <div>
                    <h5 class="mb-0">{{ $lowongan['judul'] }}</h5>
                    <small>Open Library Telkom University</small>
                </div>
            </div>
            <div class="text-end">
                @if(isset($lowongan['sisa_waktu']))
                    <small><em>{{ $lowongan['sisa_waktu'] }}</em></small><br>
                @endif
                <span class="badge bg-{{ $lowongan['label'] }}">{{ $lowongan['status'] }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
