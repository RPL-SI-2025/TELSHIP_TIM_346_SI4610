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

test('mentor dapat menerima laporan harian', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/mentor/laporan')
            ->pause(1000)
            ->assertSee('Mark Lee') 
            ->press('Terima') 
            ->pause(1000)
            ->assertSee('Laporan diterima');
    });
});

test('mentor dapat menolak laporan harian', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/mentor/laporan')
            ->pause(1000)
            ->assertSee('Jeong Jaehyun') 
            ->press('Tolak') 
            ->pause(1000)
            ->assertSee('Laporan ditolak');
    });
});
