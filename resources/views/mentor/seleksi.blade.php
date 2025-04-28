@extends('partials_mentor.template')
 
@section('main')
    {{-- ganti dari 'content' ke 'main' --}}
    <div class="d-flex" style="min-height: 100vh">
 
        {{-- Sidebar --}}
        @include('partials_mentor.sidebar_mentor')

    <div style="flex: 1; background-color: #fff5f5; margin-top: 80px;">
        <div style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 1rem 2rem; border-radius: 10px; box-shadow: 0 0 10px rgba(255,0,0,0.05); border: 1px solid #fff5f5;">
            <!-- Pelamar Info -->
            <div style="display: flex; align-items: center;">
                <img src="/foto-profil.png" alt="Foto" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 1rem;">
                <div>
                    <strong style="color: #b30000;">Muhammad Naufal</strong><br>
                    <span style="font-size: 14px; color: #a94442;">SI Sistem Informasi</span>
                </div>
                <a href="#" style="margin-left: 1rem; background-color: #fff5f5; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-size: 13px; color: #b30000; border: 1px solid #fff5f5;">Lihat Profil</a>
            </div>

            <!-- Aksi -->
            <div>
                <form method="POST" action="#" style="display:inline;">
                    @csrf
                    <button type="submit" style="background-color: #e7ffea; color: #2ae330 ; border: 1px solid #fff5f5; padding: 8px 16px; border-radius: 6px; margin-right: 8px;">Terima</button>
                </form>
                <form method="POST" action="#" style="display:inline;">
                    @csrf
                    <button type="submit" style="background-color: #fff5f5; color: #b30000; border: 1px solid #fff5f5; padding: 8px 16px; border-radius: 6px;">Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
