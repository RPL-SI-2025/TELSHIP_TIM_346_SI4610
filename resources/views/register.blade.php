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
                        <input type="text" class="form-control" id="nama" name="nama" required />
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasi-password" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konfirmasi-password"
                            name="password_confirmation" required />
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required />
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required />
                    </div>
                    <button type="submit" class="btn btn-danger w-100 mb-3">Daftar</button>
                    <a href="/registermentor" class="btn btn-outline-danger w-100">Daftar Sebagai Mentor</a>
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
    </script>
</body>

</html>