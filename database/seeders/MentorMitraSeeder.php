<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MentorMitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('mitra')->insert([
            'id_perusahaan' => 1,
            'nama_perusahaan' => 'PT Telkom Indonesia',
            'logo_perusahaan' => 'logos/telkom_logo.png',
            'deskripsi_perusahaan' => 'Perusahaan telekomunikasi terbesar di Indonesia.',
            'alamat' => 'Jl. Japati No.1, Bandung',
            'email' => 'info@telkom.co.id',
            'telepon' => '02112345678',
            'link_website' => 'https://www.telkom.co.id',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => 9,
            'name' => 'Mentor Telkom',
            'email' => 'mentor@telkom.co.id',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id_perusahaan' => 1,
            'role' => 'mentor',
        ]);


        DB::table('user_mentor')->insert([
            'id_mentor' => 1,
            'nama_lengkap' => 'Mentor Telkom',
            'email' => 'mentor@telkom.co.id',
            'password' => Hash::make('password123'),
            'id_perusahaan' => 1,
            'user_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}