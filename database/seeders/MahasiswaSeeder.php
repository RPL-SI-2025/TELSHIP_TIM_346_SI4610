<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        Mahasiswa::create([
            'nim' => '1202220000',
            'nama' => 'Muhammad Naufal',
            'email' => 'naufal@gmail.com',
            'password' => Hash::make('Naufal123'),
            'jurusan' => 'S1 Sistem Informasi',
            'no_hp' => '082121112134'
        ]);

        Mahasiswa::create([
            'nim' => '1202220001',
            'nama' => 'Aulia Rahma',
            'email' => 'aulia@gmail.com',
            'password' => Hash::make('Rahma123'),
            'jurusan' => 'S1 Teknik Informatika',
            'no_hp' => '082132112135'
        ]);
    }
}
