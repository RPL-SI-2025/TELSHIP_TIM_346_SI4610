@extends('partials_mahasiswa_login.template')

@section('main')
    <div class="d-flex" style="min-height: 100vh">

        {{-- Sidebar --}}
        @include('partials_mahasiswa_login.sidebar_mahasiswa')

        <div class="container flex-grow-1 py-4">
            <h2 class="mb-4 fw-bold text-danger">PROFIL</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Informasi Pribadi --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3 fw-semibold">Informasi Pribadi</h5>

                    <form method="POST" action="{{ route('mahasiswa.update', Auth::id()) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Profil <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if ($mahasiswa->foto_profile)
                                        <img src="{{ Storage::url('fotos/' . $mahasiswa->foto_profile) }}" alt="Foto Profil"
                                            style="width: 50px; height: 50px; object-fit: cover;" class="rounded-circle"
                                            onerror="this.src='{{ asset('app-assets/img/avatars/1.png') }}'">
                                    @else
                                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto Default"
                                            style="width: 50px; height: 50px; object-fit: cover;" class="rounded-circle">
                                    @endif

                                </div>
                                <input type="file" name="foto_profile" class="form-control"
                                    accept="image/jpeg,image/png,image/jpg">
                            </div>
                            @error('foto_profile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $user->name ?? $mahasiswa->nama_lengkap) }}"
                                class="form-control @error('nama_lengkap') is-invalid @enderror">
                            @error('nama_lengkap')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}"
                                class="form-control @error('nim') is-invalid @enderror">
                            @error('nim')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}"
                                class="form-control @error('jurusan') is-invalid @enderror">
                            @error('jurusan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email ?? $mahasiswa->email) }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Dokumen --}}
                        <h5 class="mt-4 fw-semibold">Dokumen</h5>

                        <div class="mb-3">
                            <label class="form-label">Curriculum Vitae (Wajib) <span class="text-danger">*</span></label>
                            <input type="url" name="cv" value="{{ old('cv', $mahasiswa->cv) }}"
                                class="form-control @error('cv') is-invalid @enderror" placeholder="Link CV">
                            @error('cv')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Transkrip Nilai (Wajib) <span class="text-danger">*</span></label>
                            <input type="url" name="transkrip" value="{{ old('transkrip', $mahasiswa->transkrip) }}"
                                class="form-control @error('transkrip') is-invalid @enderror" placeholder="Link Transkrip">
                            @error('transkrip')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">KTP (Wajib) <span class="text-danger">*</span></label>
                            <input type="url" name="ktp" value="{{ old('ktp', $mahasiswa->ktp) }}"
                                class="form-control @error('ktp') is-invalid @enderror" placeholder="Link KTP">
                            @error('ktp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sertifikat Pengalaman Organisasi (Opsional)</label>
                            <input type="url" name="sertifikat"
                                value="{{ old('sertifikat', $mahasiswa->sertifikat) }}"
                                class="form-control @error('sertifikat') is-invalid @enderror"
                                placeholder="Link Sertifikat">
                            @error('sertifikat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Dokumen Tambahan (Jika Perlu)</label>
                            <input type="url" name="dokumen_tambahan"
                                value="{{ old('dokumen_tambahan', $mahasiswa->dokumen_tambahan) }}"
                                class="form-control @error('dokumen_tambahan') is-invalid @enderror"
                                placeholder="Link Tambahan">
                            @error('dokumen_tambahan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
