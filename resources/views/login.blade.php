<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; overflow: hidden; }
        .full-height { height: 100vh; }
        .bg-kanan {
            background: url("{{ asset('bg.png') }}") no-repeat center center;
            background-size: cover;
        }
    </style>
</head>
<body>
<div class="d-flex w-100 full-height">
    <div class="col-md-6 d-flex align-items-center justify-content-center bg-white p-5">
        <div class="w-75">
            <h2 class="text-danger fw-bold">Masuk ke Akun</h2>
            <p class="text-muted">Selamat datang di TELSHIP</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-danger w-100 mb-3">Masuk</button>
                <a href="/register" class="btn btn-outline-danger w-100 mb-2">Daftar Sebagai Mahasiswa</a>
                <a href="/registermentor" class="btn btn-outline-danger w-100">Daftar Sebagai Mentor</a>
            </form>
        </div>
    </div>
    <div class="col-md-6 bg-kanan d-none d-md-block"></div>
</div>
</body>
</html>
