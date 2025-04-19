<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            'id_mahasiswa'   => 1, 
            'nama_lengkap'   => 'Samuel Arjuna Queen Bernard',
            'NIM'            => '102022480037',
            'email'          => 'samuelarjunaqueen@student.telkomuniversity.ac.id',
            'password'       => Hash::make('password'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}