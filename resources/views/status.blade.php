<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <div class="flex justify-between items-center px-6 py-4 bg-white shadow">
        <div class="text-2xl font-bold text-red-600">TELSHIP</div>
        <div class="flex items-center space-x-4">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M15 17h5l-1.405-1.405M21 13a9 9 0 10-9 9 9 9 0 009-9z"></path>
            </svg>
            <div class="flex items-center space-x-2">
                <img src="https://i.pravatar.cc/40" class="rounded-full w-8 h-8" alt="User Avatar">
                <span>{{ $data['user'] }}</span>
            </div>
        </div>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow">
            <div class="p-6 space-y-4">
                <div class="font-bold text-gray-700">Menu</div>
                <a href="#" class="flex items-center p-2 rounded bg-gray-100">
                    <span class="mr-2">📄</span> PROFILE
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-100">
                    <span class="mr-2">📂</span> LOWONGAN
                </a>
                <a href="#" class="flex items-center p-2 rounded bg-red-100 text-red-600">
                    <span class="mr-2">🔄</span> STATUS
                </a>
                <a href="#" class="flex items-center p-2 rounded hover:bg-gray-100">
                    <span class="mr-2">📊</span> LAPORAN
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10 bg-gray-50">
            <div class="flex space-x-4 mb-6">
                <button class="bg-gray-200 text-gray-600 px-4 py-2 rounded cursor-not-allowed" disabled>
                    STATUS PENDAFTARAN
                </button>
                <button class="bg-red-500 text-white px-4 py-2 rounded">
                    KEGIATANKU
                </button>
            </div>

            <!-- Kegiatan Card -->
            <div class="bg-white rounded shadow p-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="https://upload.wikimedia.org/wikipedia/id/0/09/Lambang_Universitas_Telkom.png"
                         alt="Logo" class="w-10 h-10">
                    <div>
                        <div class="font-bold text-lg">{{ $data['position'] }}</div>
                        <div class="text-sm text-gray-500">{{ $data['location'] }}</div>
                    </div>
                </div>
                <div class="bg-pink-100 text-pink-600 text-sm px-4 py-1 rounded-full">
                    {{ $data['status'] }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>
