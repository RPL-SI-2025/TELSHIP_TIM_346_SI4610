<?php

use Laravel\Dusk\Browser;

test('Login and View Job Posting', function () {
    $this->browse(function (Browser $browser) {
        // Step 1: Login
        $browser->visit('/')
            ->assertSee('Login')
            ->clickLink('Login')
            ->pause(1000)
            ->type('email', 'arjunaaber2@gmail.com')
            ->pause(1000)
            ->type('password', '@Qwerty123')
            ->pause(1000)
            ->press('Masuk')
            ->pause(2000)
            ->assertSee('LOWONGAN');
    });
});

test('View Fullstack Developer Job and Apply', function () {
    $this->browse(function (Browser $browser) {
        // Step 2: Melihat Lowongan dan klik Fullstack Developer
        $browser->clickLink('LOWONGAN')
            ->pause(1000)
            ->assertSee('Fullstack Developer')
            ->clickLink('Fullstack Developer')
            ->pause(2000);

        // Step 3: Pastikan ada tombol Lamar Sekarang
        $browser->assertSee('Lamar Sekarang')
            ->press('Lamar Sekarang')
            ->pause(2000);
    });
});

test('View Application Status Success', function () {
    $this->browse(function (Browser $browser) {
        // Step 4: Pastikan ada pesan sukses melamar
        $browser->assertSee('Kami Sudah Menerima Lamaranmu, Pantau Statusnya Di Halaman Status Lamaran. Semoga Sukses!')
            ->pause(2000);

        // Step 5: Tekan tombol Kembali ke halaman detail lowongan
        $browser->assertSee('Kembali')
            ->press('Kembali')
            ->pause(1000);
    });
});

test('Try Apply Again and Make Sure Not Available Status and Logout', function () {
    $this->browse(function (Browser $browser) {
        // Step 6: Coba Lamar Lagi
        $browser->assertSee('Lamar Sekarang')
            ->press('Lamar Sekarang')
            ->pause(2000);

        // Step 7: Pastikan alert dari Swal muncul dengan teks error
        $browser->assertSee('Gagal Melamar')
            ->assertSee('Kamu sudah melamar untuk lowongan ini.')
            ->pause(1000);

        // Step 8: Tekan tombol OK (SweetAlert)
        $browser->with('.swal2-container', function (Browser $modal) {
            $modal->press('OK');
        })
        ->pause(1000);

        // Step 9: Logout
        $browser->assertSee('Back')
                ->clickLink('Back')
                ->assertSee('Samuel Arjuna Queen Bernard')
                ->clickLink('Samuel Arjuna Queen Bernard') // Klik nama untuk buka dropdown
                ->pause(500)
                ->press('Logout') // Klik Logout di dropdown
                ->pause(1000);
    });
});