<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingPageTest extends DuskTestCase
{
    public function test_landing_page_displays_login_button()
    {
        $this->browse(function (Browser $browser) {
            // Kunjungi halaman awal
            $browser->visit('/')
                ->pause(1000) // jeda 1 detik
                ->assertSee('Login') // pastikan ada tulisan Login
                ->clickLink('Login') // klik link/tombol yang ada teks Login
                ->pause(1000); // jeda 1 detik
        });
    }

    public function test_landing_page_displays_register_button()
    {
        $this->browse(function (Browser $browser) {
            // Kembali ke halaman awal
            $browser->visit('/')
                ->pause(1000) // jeda 1 detik
                ->assertSee('Register') // pastikan ada tulisan Register
                ->clickLink('Register') // klik link/tombol yang ada teks Register
                ->pause(1000); // jeda 1 detik
        });
    }
}