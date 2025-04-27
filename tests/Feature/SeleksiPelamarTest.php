<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\Mahasiswa;

class SeleksiPelamarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_pelamar_list_for_given_lowongan()
    {
        // Arrange: Membuat data lowongan dan pelamar
        $mahasiswa = Mahasiswa::factory()->create([
            'nama' => 'Muhammad Naufal',
            'jurusan' => 'SI Sistem Informasi',
        ]);

        $lowongan = Lowongan::factory()->create();

        $pelamar = Pelamar::factory()->create([
            'lowongan_id' => $lowongan->id,
            'mahasiswa_id' => $mahasiswa->id,
        ]);

        // Act: Akses route ke metode pelamar
        $response = $this->get(route('seleksi.pelamar', $lowongan->id));

        // Assert: Memastikan tampilan dan data yang muncul
        $response->assertStatus(200);
        $response->assertViewIs('mentor.index');
        $response->assertViewHas('lowongan', function ($viewLowongan) use ($pelamar, $mahasiswa) {
            return $viewLowongan->pelamar->contains(function ($p) use ($mahasiswa) {
                return $p->mahasiswa->nama === 'Muhammad Naufal' &&
                       $p->mahasiswa->jurusan === 'SI Sistem Informasi';
            });
        });

        $response->assertSeeText('Muhammad Naufal');
        $response->assertSeeText('SI Sistem Informasi');
    }
}
