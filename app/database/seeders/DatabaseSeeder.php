<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder yang diperlukan
        $this->call([
            MahasiswaSeeder::class,
            MentorSeeder::class,
            MitraSeeder::class, // Ini untuk perusahaan
        ]);
    }
}
