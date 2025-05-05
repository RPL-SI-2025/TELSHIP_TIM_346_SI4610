<?php

use Laravel\Dusk\Browser;
//tambahkan error 
test('login to the application', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->assertSee('Login')
            ->clickLink('Login')
            ->pause(1000)
            ->type('email', 'arjunaaber2@gmail.com')
            ->pause(1000)
            ->type('password', '@Qwerty123')
            ->pause(1000)
            ->press('Masuk') // Tekan tombol Login
            ->pause(2000);
    });
});

test('fill form correctly after login', function () {
    $this->browse(function (Browser $browser) {
        // Mulai isi form setelah login
        $browser->scrollIntoView('input[name="transkrip"]')
            ->type('transkrip', 'https://drive.test.com')
            ->pause(1000)

            ->scrollIntoView('input[name="ktp"]')
            ->type('ktp', 'https://drive.test.com')
            ->pause(1000)

            ->scrollIntoView('input[name="sertifikat"]')
            ->type('sertifikat', 'https://drive.test.com')
            ->pause(1000)

            ->scrollIntoView('input[name="dokumen_tambahan"]')
            ->type('dokumen_tambahan', 'https://drive.test.com')
            ->pause(1000)

            // Simpan
            ->scrollIntoView('button[type="submit"]')
            ->assertSee('Simpan')
            ->press('Simpan')
            ->pause(2000);
    });
});

test('logout after filling the form', function () {
    $this->browse(function (Browser $browser) {
        // Cari nama user dan logout
        $browser->assertSee('Samuel Arjuna Queen Bernard')
            ->clickLink('Samuel Arjuna Queen Bernard') // klik nama user untuk buka dropdown
            ->pause(500)
            ->press('Logout') // klik Logout di dropdown
            ->pause(1000);
    });
});