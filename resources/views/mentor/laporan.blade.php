@extends('partials_mentor.template')
 
 @section('main')
     <div class="d-flex" style="min-height: 100vh">
  
         {{-- Sidebar --}}
         @include('partials_mentor.sidebar_mentor')
  
         <div style="flex: 1; margin-top: 80px;">
             {{-- Notifikasi --}}
             @if (session('success'))
                 <div class="alert alert-success" style="margin-bottom: 1rem;">
                     {{ session('success') }}
                 </div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger">
                     {{ session('error') }}
                 </div>
             @endif
  
             @foreach ($laporans as $laporan)
                 <div
                     style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 1rem 2rem; border-radius: 10px; border: 1px solid #fff5f5; margin-bottom: 1rem;">
                     <!-- Pelamar Info -->
                     <div style="display: flex; align-items: center;">
                         <img src="{{ $laporan->mahasiswa && $laporan->mahasiswa->foto_profile ? Storage::url('fotos/' . $laporan->mahasiswa->foto_profile) : asset('images/default-profile.png') }}"
                             alt="Foto"
                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 1rem;"
                             onerror="this.src='{{ asset('app-assets/img/avatars/1.png') }}'">
                         <div>
                             <strong style="color: #000000;">
                                 {{ $laporan->mahasiswa ? $laporan->mahasiswa->nama_lengkap : 'Nama Tidak Tersedia' }}
                             </strong><br>
                             <span style="font-size: 14px; color: #979797;">
                                 @if ($laporan->jenis_laporan == 'laporan_harian')
                                     Laporan Harian
                                 @elseif($laporan->jenis_laporan == 'izin')
                                     Laporan Izin
                                 @else
                                     {{ $laporan->jenis_laporan ?? 'Jenis Laporan Tidak Tersedia' }}
                                 @endif
                             </span>
  
                         </div>
                         <a href="#" data-bs-toggle="modal" data-bs-target="#modalProfil-{{ $laporan->id_laporan }}"
                             style="margin-left: 1rem; background-color: #DBDBDB33; padding: 5px 10px; border-radius: 5px; text-decoration: none; font-size: 13px; color: #686868; border: 1px solid #686868;">
                             Lihat Detail
                         </a>
  
                     </div>
  
                     <!-- Aksi -->
                     <div>
                         <form method="POST" action="{{ route('mentor.laporan.terima', $laporan->id_laporan) }}"
                             style="display:inline;">
                             @csrf
                             <button type="submit"
                                 style="background-color: #e7ffea; color: #2ae330 ; border: 1px solid #2ae330; padding: 8px 16px; border-radius: 6px; margin-right: 8px;">Terima</button>
                         </form>
                         <form method="POST" action="{{ route('mentor.laporan.tolak', $laporan->id_laporan) }}"
                             style="display:inline;">
                             @csrf
                             <button type="submit"
                                 style="background-color: #fff5f5; color: #b30000; border: 1px solid #b30000; padding: 8px 16px; border-radius: 6px;">Tolak</button>
                         </form>
                     </div>
                 </div>
  
                 <!-- Modal Profil -->
                 <div class="modal fade" id="modalProfil-{{ $laporan->id_laporan }}" tabindex="-1"
                     aria-labelledby="profilModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-scrollable">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title">Detail Profil Mahasiswa</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 @php
                                     $mahasiswa = $laporan->mahasiswa;
                                     $user = $mahasiswa->user ?? null;
                                     $dokumen = $mahasiswa->dokumen ?? null;
                                 @endphp
  
                                 <div class="d-flex align-items-center mb-4">
                                     @if ($mahasiswa && $mahasiswa->foto_profile)
                                         <img src="{{ Storage::url('fotos/' . $mahasiswa->foto_profile) }}"
                                             alt="Foto Profil" style="width: 80px; height: 80px; object-fit: cover;"
                                             class="rounded-circle me-3"
                                             onerror="this.src='{{ asset('app-assets/img/avatars/1.png') }}'">
                                     @else
                                         <img src="{{ asset('images/default-profile.png') }}" alt="Foto Default"
                                             style="width: 80px; height: 80px; object-fit: cover;"
                                             class="rounded-circle me-3">
                                     @endif
                                     <div>
                                         <h5 class="mb-0">{{ $mahasiswa->nama_lengkap ?? '-' }}</h5>
                                         <small class="text-muted">{{ $mahasiswa->nim ?? '-' }}</small>
                                     </div>
                                 </div>
  
                                 <div class="mb-3">
                                     <strong>Jurusan:</strong>
                                     <p>{{ $mahasiswa->jurusan ?? '-' }}</p>
                                 </div>
  
                                 <div class="mb-3">
                                     <strong>Email:</strong>
                                     <p>{{ $user->email ?? ($mahasiswa->email ?? '-') }}</p>
                                 </div>
  
                                 <div class="mb-3">
                                     <strong>Deskripsi:</strong>
                                     <p>{{ $laporan->deskripsi_pekerjaan ?? '-' }}</p>
                                 </div>
  
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 @endsection