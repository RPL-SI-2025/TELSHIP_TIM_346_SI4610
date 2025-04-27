<?php

namespace Database\Factories;

use App\Models\Pelamar;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelamarFactory extends Factory
{
    protected $model = Pelamar::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'mahasiswa_id' => Mahasiswa::factory(),
        ];
    }
}
