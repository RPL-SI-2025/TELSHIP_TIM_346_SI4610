<?php

use Laravel\Dusk\Browser;

test('mentor dapat login', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->pause(2000)
            ->type('email', 'mentor@telkom.co.id')
            ->pause(2000)
            ->type('password', 'password123')
            ->pause(2000)
            ->press('Masuk')
            ->pause(2000);
    });
});

test('mentor dapat menolak pelamar', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/seleksi/2')
            ->pause(1000)
            ->assertSee('Mark Lee') 
            ->press('Tolak') 
            ->pause(1000)
            ->assertSee('Lamaran ditolak');
    });
});

test('mentor dapat menerima pelamar', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/seleksi/2')
            ->pause(1000)
            ->assertSee('Jeong Jaehyun')
            ->press('Terima')
            ->pause(1000)
            ->assertSee('Lamaran diterima');
    });
});
