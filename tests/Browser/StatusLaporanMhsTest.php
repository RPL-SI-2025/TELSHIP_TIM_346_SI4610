<?php

use Laravel\Dusk\Browser;

test('check the status of laporan first', function () {
    $this->browse(function (Browser $browser) {
        // Login
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

        // Mencari dan mengklik link "STATUS LAPORAN"
        $browser->assertSee('LAPORAN')
            ->clickLink('LAPORAN')
            ->assertSee('STATUS LAPORAN')
            ->clickLink('STATUS LAPORAN')
            ->pause(2000);

        // Verifikasi jumlah laporan yang ada (misalnya cek apakah ada laporan yang ditampilkan)
        $browser->assertSee('Laporan') // Pastikan ada Laporan yang terdaftar
            ->pause(1000);
    });
});

test('upload laporan and return to status', function () {
    $this->browse(function (Browser $browser) {
        // Kembali ke halaman "LAPORAN"
        $browser->assertSee('LAPORAN')
            ->clickLink('LAPORAN')
            ->pause(1000);

        // Memilih tanggal 1 Juni 2025 dari input date
        $browser->scrollIntoView('input[name="tanggal"]')
            ->click('input[name="tanggal"]') // Klik input tanggal untuk membuka kalender
            ->pause(1000)
            ->keys('input[name="tanggal"]', '06/01/2025') // Pilih tanggal 1 Juni 2025
            ->pause(1000);

        // Mengisi deskripsi laporan
        $browser->scrollIntoView('textarea[name="deskripsi"]')
            ->type('textarea[name="deskripsi"]', 'UNTUK MENGECEK STATUS LAPORAN HABIS INI')
            ->pause(1000);

        // Kirim laporan
        $browser->assertSee('Kirim Laporan')
            ->press('Kirim Laporan')
            ->pause(2000);

        // Kembali ke status laporan
        $browser->assertSee('STATUS LAPORAN')
            ->clickLink('STATUS LAPORAN')
            ->pause(2000);

        // Verifikasi bahwa laporan baru telah ditambahkan
        $browser->assertSee('Laporan') // Pastikan laporan yang baru ditambahkan terlihat
            ->pause(1000);
    });
});

test('logout after checking status', function () {
    $this->browse(function (Browser $browser) {
        // Pastikan pengguna dapat melihat nama mereka dan logout
        $browser->assertSee('Samuel Arjuna Queen Bernard')
            ->clickLink('Samuel Arjuna Queen Bernard') // klik nama user untuk buka dropdown
            ->pause(500)
            ->press('Logout') // klik Logout di dropdown
            ->pause(1000);
    });
});