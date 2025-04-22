<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Laporan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\MahasiswaSeeder;

class LaporanTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed mahasiswa agar id_mahasiswa = 1 tersedia
        $this->seed(MahasiswaSeeder::class);
    }

        /** @test */
        public function user_bisa_mengakses_halaman_form_laporan_harian()
        {
            $response = $this->get(route('laporan.index'));

            $response->assertStatus(200);
            $response->assertSee('Laporan Harian');
            $response->assertSee('Tuliskan kegiatanmu hari ini');
        }
    /** @test */
    public function user_bisa_mengirimkan_form_laporan_dengan_data_valid()
    {
        $data = [
            'tanggal' => now()->format('Y-m-d'),
            'deskripsi' => 'Hari ini saya mengerjakan tugas Laravel dan membuat form laporan.',
        ];

        $response = $this->post(route('laporan.store'), $data); // Mengirimkan data laporan

        $response->assertRedirect(); // redirect ke halaman sebelumnya
        $response->assertSessionHas('success', 'Laporan berhasil dikirim!');

        $this->assertDatabaseHas('laporan', [
            'id_mahasiswa' => 1, // ID mahasiswa yang disesuaikan
            'jenis_laporan' => 'laporan_harian',
            'tanggal' => $data['tanggal'],
            'deskripsi_pekerjaan' => $data['deskripsi'],
            'status' => 'diproses',
        ]);
    }

    /** @test */
    public function validasi_gagal_jika_field_tidak_diisi()
    {
        $response = $this->post(route('laporan.store'), []); // Kirim data kosong

        $response->assertSessionHasErrors(['tanggal', 'deskripsi']); // Pastikan ada error jika form kosong
    }

    
}