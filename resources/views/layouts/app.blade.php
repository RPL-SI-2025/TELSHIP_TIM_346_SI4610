<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Telship Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- pastikan TailwindCSS di-load --}}
</head>
<body class="bg-white font-sans text-gray-800">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col justify-between">
            <div>
                <div class="px-6 py-4">
                    <img src="{{ asset('telshiplogo.png') }}" alt="Telship" class="h-7">
                </div>
                <nav class="px-6">
                    <a href="#" class="flex items-center px-4 py-2 text-red-600 font-semibold bg-red-50 rounded mb-2">
                        <span class="mr-2">👤</span> PENGGUNA
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-500 hover:bg-gray-100 rounded mb-2">
                        <span class="mr-2">📄</span> LOWONGAN
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-500 hover:bg-gray-100 rounded">
                        <span class="mr-2">📊</span> MONITORING
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="flex justify-between items-center bg-white shadow px-6 py-4">
                <div></div>
                <div class="flex items-center space-x-4">
                    <span class="text-xl">🔔</span>
                    <img src="{{ asset('images/avatar.png') }}" alt="User" class="h-8 w-8 rounded-full object-cover">
                    <div class="text-sm font-medium">Alexa ▼</div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
