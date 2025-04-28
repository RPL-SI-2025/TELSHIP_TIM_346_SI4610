<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .bg-kanan {
            background: url("{{ asset('bg.png') }}") no-repeat center center;
            background-size: cover;
        }

        .form-container {
            max-height: 90vh;
            /* Membatasi tinggi form agar tetap terlihat dan bisa di-scroll */
            overflow-y: auto;
            /* Menambahkan scroll hanya pada form */
            padding-top: 20px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            /* Memberikan jarak antara judul dan form */
        }

        .form-container p {
            margin-bottom: 20px;
            /* Memberikan jarak antara paragraf dan form */
        }
    </style>
</head>

<body>
    <div class="d-flex w-100 full-height">
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-white p-5">
            <div class="w-75 form-container">
                <h2 class="text-danger fw-bold">Daftar Sebagai Mahasiswa</h2>
                <p class="text-muted">Welcome to TELSHIP</p>

                <form action="{{ route('register.store') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama') }}" required />
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                            name="nim" value="{{ old('nim') }}" required />
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 mt-3"
                            onclick="togglePassword('password', this)" style="cursor: pointer;">
                            👁️
                        </span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="konfirmasi-password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfirmasi-password"
                            name="password_confirmation" required />
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3 mt-3"
                            onclick="togglePassword('konfirmasi-password', this)" style="cursor: pointer;">
                            👁️
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                            name="jurusan" value="{{ old('jurusan') }}" required />
                        @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                            name="no_hp" value="{{ old('no_hp') }}" required />
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger w-100 mb-3">Daftar</button>
                    <p class="mt-3">Sudah punya akun? <a href="/login" class="text-danger">Masuk</a></p>
                </form>

            </div>
        </div>
        <div class="col-md-6 bg-kanan d-none d-md-block"></div>
    </div>

    <script>
        function validateForm() {
            const password = document.getElementById("password").value;
            const konfirmasi = document.getElementById("konfirmasi-password").value;
            if (password !== konfirmasi) {
                alert("Password dan konfirmasi password tidak cocok.");
                return false;
            }
            return true;
        }

        function validateForm() {
            var noHp = document.getElementById('no_hp').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('konfirmasi-password').value;

            var hpRegex = /^[0-9]+$/;
            var passwordRegex = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;

            if (!hpRegex.test(noHp)) {
                alert("Nomor HP hanya boleh berisi angka.");
                return false;
            }

            if (!passwordRegex.test(password)) {
                alert("Password minimal 8 karakter, mengandung minimal 1 huruf besar dan 1 karakter spesial.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Konfirmasi password tidak cocok.");
                return false;
            }

            return true;
        }

        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
                icon.textContent = "🙈"; // Ganti icon kalau password kelihatan
            } else {
                field.type = "password";
                icon.textContent = "👁️"; // Balik lagi kalau disembunyikan
            }
        }

        function validateForm() {
            var noHp = document.getElementById('no_hp').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('konfirmasi-password').value;

            var hpRegex = /^[0-9]+$/;
            var passwordRegex = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;

            if (!hpRegex.test(noHp)) {
                alert("Nomor HP hanya boleh berisi angka.");
                return false;
            }

            if (!passwordRegex.test(password)) {
                alert("Password minimal 8 karakter, mengandung minimal 1 huruf besar dan 1 karakter spesial.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Konfirmasi password tidak cocok.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>