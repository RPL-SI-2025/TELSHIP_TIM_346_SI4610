@extends('layouts.app') {{-- Sesuaikan dengan layout kamu --}}
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow-lg" style="width: 600px;">
        <h4 class="mb-3 text-center">Menambahkan Mitra / ID Perusahaan</h4>
        <p class="text-center text-muted">Lengkapi kolom berikut untuk menambahkan ID Perusahaan</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="company_id" class="form-label">ID Perusahaan</label>
                <input type="text" class="form-control" name="company_id" id="company_id" placeholder="Ketik disini" required>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo Perusahaan</label>
                <input type="file" class="form-control" name="logo" id="logo">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ketik disini" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Perusahaan</label>
                <textarea class="form-control" name="description" id="description" placeholder="Ketik disini" rows="3"></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-danger">Lanjut</button>
            </div>
        </form>
    </div>
</div>
@endsection
