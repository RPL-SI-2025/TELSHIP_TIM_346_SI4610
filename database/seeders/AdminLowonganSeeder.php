<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminLowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_lowongan')->insert([
            'title' => 'Front-End Developer',
            'company' => 'Open Library Telkom University',
            'logo' => 'img7.png',
            'status' => 'pending'
        ]);

        DB::table('admin_lowongan')->insert([
            'title' => 'Back-End Developer',
            'company' => 'Telkom Indonesia',
            'logo' => 'img7.png',
            'status' => 'pending'
        ]);
    }
}
