<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_login_bisa_diakses()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk ke Akun');
    }

    /** @test */
    public function user_tidak_bisa_login_dengan_kredensial_salah()
    {
        // Buat user tapi pakai password yang tidak akan digunakan untuk login
        $user = User::factory()->create([
            'email' => 'tes@example.com',
            'password' => bcrypt('passwordbenar'),
        ]);

        $response = $this->post('/login', [
            'email' => 'tes@example.com',
            'password' => 'passwordsalah',
        ]);

        $response->assertSessionHas('error', 'Email atau password salah.');
        $this->assertGuest();
    }

    /** @test */
    public function user_bisa_login_dengan_kredensial_benar()
    {
        $user = User::factory()->create([
            'email' => 'tes@example.com',
            'password' => bcrypt('rahasia123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'tes@example.com',
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect('/dashboard'); // Sesuaikan dengan redirect kamu
        $this->assertAuthenticatedAs($user);
    }
}
