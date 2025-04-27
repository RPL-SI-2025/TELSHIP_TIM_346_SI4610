<div class="bg-light p-3" style="width: 250px;">
    <!-- Logo Telship -->
    <div class="text-center mb-3">
      
    </div>

    <h4 class="text-center">Menu</h4>

    <ul class="nav flex-column">
        <!-- LOWONGAN Aktif -->
        <li class="nav-item mb-2">
            <a href="{{ route('lowongan.index') }}" class="nav-link d-flex align-items-center justify-content-start active"
               style="border: 1px solid #d43f3a; background-color: #fff5f5; color: #b22222; border-radius: 10px; padding: 10px;">
                <span class="me-2">🏢</span> <!-- Ganti dengan ikon sesuai preferensi -->
                <strong>LOWONGAN</strong>
            </a>
        </li>

        <!-- LAPORAN Tidak Aktif -->
        <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center justify-content-start text-muted"
               style="background-color: #f2f2f2; border-radius: 10px; padding: 10px;">
                <span class="me-2">📊</span>
                LAPORAN
            </a>
        </li>
    </ul>
</div>
