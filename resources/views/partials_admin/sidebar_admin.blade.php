@php
    $activePage = request()->segment(2);
    if (empty($activePage)) {
        $activePage = '';
    }
    $activePage = $activePage ?? '';
@endphp
<div class="p-3" style="width: 250px; background-color: #ffffff; box-shadow: 0 0 10px rgba(0,0,0,0.05); height: 100%;">
    <h6 class="text-muted mb-4" style="margin-top: 60px;">Menu</h6>

    <ul class="nav flex-column" style="list-style: none; padding-left: 0;">
        <li class="nav-item mb-2">
            @if ($activePage == 'pengguna')
                <a href="/admin/pengguna" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #ffffff; border: 1px solid #e74c3c;">
                    <span style="color: #6c757d; font-weight: 600;">
                        <img src="{{ asset('assets/icons/profile-icon.svg') }}" alt="Profile" width="18"
                            style="margin-right: 8px;">
                        PENGGUNA
                    </span>
                </a>
            @else
                <a href="/admin/pengguna" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #f0f0f0; border: none;">
                    <span style="color: #a0a0a0; font-weight: 400;">
                        <img src="{{ asset('assets/icons/profile-icon-no.svg') }}" alt="Profile" width="18"
                            style="margin-right: 8px;">
                        PENGGUNA
                    </span>
                </a>
            @endif
        </li>

        <li class="nav-item mb-2">
            @if (Request::is('lowongan'))
                <a href="/lowongan" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #ffffff; border: 1px solid #e74c3c;">
                    <span style="color: #e74c3c; font-weight: 600;">
                        <img src="{{ asset('assets/icons/lowongan-icon.svg') }}" alt="Lowongan" width="18"
                            style="margin-right: 8px;">
                        LOWONGAN
                    </span>
                </a>
            @else
                <a href="/lowongan" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #f0f0f0; border: none;">
                    <span style="color: #a0a0a0; font-weight: 400;">
                        <img src="{{ asset('assets/icons/lowongan-icon-no.svg') }}" alt="Lowongan" width="18"
                            style="margin-right: 8px;">
                        LOWONGAN
                    </span>
                </a>
            @endif
        </li>
        <li class="nav-item mb-2">
            @if (Request::is('monitoring/mahasiswa'))
                <!-- Versi dengan border merah dan teks merah untuk menu aktif -->
                <a href="/monitoring/mahasiswa" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #ffffff; border: 1px solid #e74c3c;">
                    <span style="color: #e74c3c; font-weight: 600;">
                        <img src="{{ asset('assets/icons/report-icon.svg') }}" alt="Laporan" width="18"
                            style="margin-right: 8px;">
                        MONITORING
                    </span>
                </a>
            @else
                <!-- Versi dengan latar belakang abu-abu untuk menu tidak aktif -->
                <a href="/monitoring/mahasiswa" class="nav-link text-decoration-none"
                    style="display: block; padding: 10px 12px; border-radius: 6px; background-color: #f0f0f0; border: none;">
                    <span style="color: #a0a0a0; font-weight: 400;">
                        <img src="{{ asset('assets/icons/report-icon-no.svg') }}" alt="Laporan" width="18"
                            style="margin-right: 8px;">
                        MONITORING
                    </span>
                </a>
            @endif
        </li>
    </ul>
</div>