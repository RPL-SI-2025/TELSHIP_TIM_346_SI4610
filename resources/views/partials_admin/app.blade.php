<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TELSHIP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="d-flex">
        <div class="bg-white p-3" style="width: 200px; min-height: 100vh;">
            <h5 class="fw-bold">TELSHIP</h5>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link" href="#">👤 PENGGUNA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-danger fw-bold" href="{{ route('lowongan.index') }}">📄 LOWONGAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">🔲 MONITORING</a>
                </li>
            </ul>
        </div>
        <div class="flex-grow-1">
            <div class="d-flex justify-content-end align-items-center p-3 bg-white shadow-sm">
                <img src="https://i.pravatar.cc/30" class="rounded-circle me-2" alt="Avatar">
                <span>Alexa ▾</span>
            </div>
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
