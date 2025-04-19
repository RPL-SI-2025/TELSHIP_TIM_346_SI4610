@extends('layouts.app') {{-- Pastikan ini sesuai layout utama kamu --}}

@section('content')
<div class="container">
    <h2 class="text-2xl font-semibold mb-4">PENGGUNA</h2>

    <div class="flex mb-4">
        <a href="#" class="btn btn-danger active mr-2">MAHASISWA</a>
        <a href="#" class="btn btn-outline-secondary mr-2">MENTOR</a>
        <a href="#" class="btn btn-outline-secondary">ID PERUSAHAAN</a>
    </div>

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">NIM</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Password</th>
                <th class="border px-4 py-2">Jurusan</th>
                <th class="border px-4 py-2">No HP</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $mhs)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $mhs->nim }}</td>
                <td class="border px-4 py-2">{{ $mhs->nama }}</td>
                <td class="border px-4 py-2">{{ $mhs->email }}</td>
                <td class="border px-4 py-2">{{ $mhs->password }}</td>
                <td class="border px-4 py-2">{{ $mhs->jurusan }}</td>
                <td class="border px-4 py-2">{{ $mhs->no_hp }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="text-blue-500 mr-2">
                        ✏️
                    </a>
                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="text-red-500">
                            🗑️
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
