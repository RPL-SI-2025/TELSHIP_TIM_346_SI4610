<?php

use Laravel\Dusk\Browser;

test('check the status of laporan first', function () {
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

        // Navigasi ke halaman STATUS LAPORAN
        $browser->assertSee('LOWONGAN')
            ->clickLink('LOWONGAN')

            // Verifikasi adanya laporan
            ->assertSee('LOWONGAN')
            ->pause(1000);
    });
});


test('logout after checking status', function () {
    $this->browse(function (Browser $browser) {
        $browser->waitForText('Muhammad Ikramulhaqqi', 5)
            ->assertSee('Muhammad Ikramulhaqqi')
            ->clickLink('Muhammad Ikramulhaqqi')
            ->pause(500)
            ->press('Logout')
            ->pause(1000);
    });
});
