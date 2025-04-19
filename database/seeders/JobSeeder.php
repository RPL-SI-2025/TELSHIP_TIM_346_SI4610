<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            'title' => 'Front-End Developer',
            'company' => 'Open Library Telkom University',
            'logo' => 'logo.png', // jika kamu pakai logo
            'status' => 'pending'
        ]);

        DB::table('jobs')->insert([
            'title' => 'Front-End Developer',
            'company' => 'Open Library Telkom University',
            'logo' => 'logo.png',
            'status' => 'pending'
        ]);
    }
}
