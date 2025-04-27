<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterMahasiswaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_register_dapat_diakses()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar Sebagai Mahasiswa');
    }

    /** @test */
    public function register_gagal_jika_data_kosong()
    {
        $response = $this->post('/register', []);

        $response->assertSessionHasErrors(['nama', 'nim', 'email', 'password']);
    }

    /** @test */
    public function register_gagal_jika_email_sudah_digunakan()
    {
        User::create([
            'name' => 'Bryan',
            'nim' => '123456',
            'email' => 'bryan@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/register', [
            'nama' => 'Bryan',
            'nim' => '789012',
            'email' => 'bryan@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_dapat_register_dengan_data_valid()
    {
        $response = $this->post('/register', [
            'nama' => 'Sarah Praditya',
            'nim' => '234567',
            'email' => 'sarah@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'sarah@example.com',
        ]);
    }
}
