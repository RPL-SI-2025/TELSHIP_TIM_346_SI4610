<?php

use Laravel\Dusk\Browser;

test('check lowongan detail and logout', function () {
    $this->browse(function (Browser $browser) {
        // Login
        $browser->visit('http://127.0.0.1:8000')
            ->assertSee('Login')
            ->clickLink('Login')
            ->pause(1000)
            ->type('email', 'ikramulhaqqi@gmail.com')
            ->pause(500)
            ->type('password', 'B@ndung20mei')
            ->pause(500)
            ->press('Masuk')
            ->pause(2000);

        // Navigasi ke halaman LOWONGAN
        $browser->assertSee('STATUS')
            ->clickLink('STATUS')
            ->pause(1000);
        });
    });
    

