<?php

namespace Tests\Feature;

use Tests\TestCase;

class LowonganTest extends TestCase
{
    /** @test */
    public function halaman_index_lowongan_dapat_diakses()
    {
        $response = $this->get(route('lowongan.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function halaman_index_lowongan_menampilkan_data_lowongan()
    {
        $response = $this->get(route('lowongan.index'));

        $response->assertSee('Front-End Developer');
        $response->assertSee('3 Hari Tersisa');
        $response->assertSee('Aktif');
        $response->assertSee('Diproses');
        $response->assertSee('Ditolak');
        $response->assertSee('Selesai');
    }

    /** @test */
    public function tombol_tambah_lowongan_muncul_di_halaman_index()
    {
        $response = $this->get(route('lowongan.index'));

        $response->assertSee('+ TAMBAH LOWONGAN');
    }
}
