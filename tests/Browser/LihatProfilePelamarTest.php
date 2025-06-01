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

test('mentor dapat melihat profile pelamar', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/seleksi/2')
            ->pause(1000)
            ->assertSee('Muhammad Asahi') 
            -> clicklink('Lihat Profil') 
            ->pause(1000)
            ->assertSee('Detail Profil Mahasiswa')
            ->pause(1000)
            ->press('Tutup');
    });
});
