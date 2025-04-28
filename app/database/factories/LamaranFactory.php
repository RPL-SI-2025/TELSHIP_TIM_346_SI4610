<?php

namespace Database\Factories;

use App\Models\Lamaran;
use App\Models\Pelamar;
use Illuminate\Database\Eloquent\Factories\Factory;

class LamaranFactory extends Factory
{
    protected $model = Lamaran::class;

    public function definition()
    {
        return [
            'pelamar_id' => Pelamar::factory(),
            'id_lowongan' => 1, 
            'status' => 'pending',
        ];
    }
}
