<?php

use Laravel\Dusk\Browser;
//tambhakn  alert error
test('Check Login Functionality', function () {
    $this->browse(function (Browser $browser) {
        // Tes 1: Login
        $browser->visit('/')
                ->assertSee('Login')
                ->clickLink('Login')
                ->pause(1000)
                ->type('email', 'arjunaaber2@gmail.com')
                ->pause(1000)
                ->type('password', '@Qwerty123')
                ->pause(1000)
                ->press('Masuk') // Tekan tombol Login
                ->pause(2000)
                ->assertSee('LAPORAN'); // Pastikan halaman Laporan muncul setelah login
    });
});

test('Submit Izin with Date 08/05/2025', function () {
    $this->browse(function (Browser $browser) {
        // Tes 2: Kirim laporan dengan tanggal 06/01/2025
        $browser->clicklink('LAPORAN')
                ->assertSee('MINTA IZIN')
                ->clicklink('MINTA IZIN')
                ->scrollIntoView('input[name="tanggal"]')
                ->click('input[name="tanggal"]')
                ->pause(1000)
                ->keys('input[name="tanggal"]', '08/05/2025')
                ->pause(1000)
                ->scrollIntoView('textarea[name="deskripsi"]')
                ->type('textarea[name="deskripsi"]', 'Izin tes pertama untuk tanggal 08/05/2025')
                ->pause(1000)
                ->press('Kirim Izin')
                ->pause(2000)
                ->assertSee('Izin berhasil dikirim'); // Pastikan ada konfirmasi setelah laporan dikirim
    });
});

test('Submit Report with Date 10/07/2025', function () {
    $this->browse(function (Browser $browser) {
        // Tes 3: Kirim laporan dengan tanggal 06/07/2025
        $browser->clicklink('MINTA IZIN')
                ->scrollIntoView('input[name="tanggal"]')
                ->click('input[name="tanggal"]')
                ->pause(1000)
                ->keys('input[name="tanggal"]', '10/07/2025')
                ->pause(1000)
                ->scrollIntoView('textarea[name="deskripsi"]')
                ->type('textarea[name="deskripsi"]', 'Izin tes kedua untuk tanggal 10/07/2025')
                ->pause(1000)
                ->press('Kirim Izin')
                ->pause(2000)
                ->assertSee('Izin berhasil dikirim'); // Pastikan ada konfirmasi setelah laporan dikirim
    });
});

test('Logout and Verify', function () {
    $this->browse(function (Browser $browser) {
        // Tes 4: Logout
        $browser->assertSee('Samuel Arjuna Queen Bernard')
                ->clickLink('Samuel Arjuna Queen Bernard') // Klik nama untuk buka dropdown
                ->pause(500)
                ->press('Logout') // Klik Logout di dropdown
                ->pause(1000);
    });
});