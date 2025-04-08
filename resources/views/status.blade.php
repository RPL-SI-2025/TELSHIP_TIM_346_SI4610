

@section('content')
<div class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r p-4">
        <div class="text-2xl font-bold mb-8 text-red-600">TELSHIP</div>
        <nav class="space-y-4">
            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-red-500">
                <i class="fas fa-user"></i><span>PROFILE</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-red-500">
                <i class="fas fa-briefcase"></i><span>LOWONGAN</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-red-600 font-bold">
                <i class="fas fa-sync-alt"></i><span>STATUS</span>
            </a>
            <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-red-500">
                <i class="fas fa-file-alt"></i><span>LAPORAN</span>
            </a>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <div class="space-x-2">
                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded">STATUS PENDAFTARAN</button>
                <button class="px-4 py-2 bg-red-600 text-white rounded">KEGIATANKU</button>
            </div>
            <div class="flex items-center space-x-2">
                <span>Alexa</span>
                <img src="https://i.pravatar.cc/40" class="w-8 h-8 rounded-full" alt="User Avatar">
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://upload.wikimedia.org/wikipedia/id/8/8a/Logo_Universitas_Telkom.png" class="w-12 h-12" alt="Logo">
                <div>
                    <div class="font-bold">Front-End Developer</div>
                    <div class="text-sm text-gray-500">Open Library Telkom University</div>
                </div>
            </div>
            <span class="bg-purple-100 text-purple-600 text-sm px-3 py-1 rounded-full">Aktif</span>
        </div>
    </main>
</div>
@endsection
