<?php
// Dashboard Telship
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Telship Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">

    <!-- Sidebar -->
    <div class="bg-white w-64 p-6 shadow-md">
      <!-- Logo Telship -->
      <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-red-600">Telship</h2>
      </div>

      <h4 class="text-lg font-semibold mb-4 text-gray-700">Menu</h4>

      <ul class="space-y-2">
        <!-- LOWONGAN Aktif -->
        <li>
          <a href="{{ route('lowongan.index') }}" class="flex items-center space-x-2 p-3 bg-red-100 text-red-700 rounded-lg border border-red-500 font-semibold">
            <span>🏢</span>
            <span>LOWONGAN</span>
          </a>
        </li>

        <!-- LAPORAN Tidak Aktif -->
        <li>
          <a href="#" class="flex items-center space-x-2 p-3 bg-gray-200 text-gray-500 rounded-lg">
            <span>📊</span>
            <span>LAPORAN</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <span class="text-gray-500">Desktop - 37</span>
        <div class="flex items-center space-x-4">
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
          <span>Alexa</span>
          <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z"/>
          </svg>
        </div>
      </div>

      <!-- User Card -->
      <div class="bg-white shadow-md rounded-lg p-4 flex items-center justify-between">
        <div class="flex items-center">
          <img class="w-12 h-12 rounded-full mr-4" src="https://via.placeholder.com/48" alt="Profile">
          <div>
            <div class="font-semibold">Muhammad Naufal</div>
            <div class="text-sm text-gray-500">S1 Sistem Informasi</div>
          </div>
        </div>
        <div class="flex items-center space-x-2">
          <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded">Lihat Profile</button>
          <button class="px-3 py-1 bg-green-200 text-green-800 text-sm rounded">Terima</button>
          <button class="px-3 py-1 bg-red-200 text-red-800 text-sm rounded">Tolak</button>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
