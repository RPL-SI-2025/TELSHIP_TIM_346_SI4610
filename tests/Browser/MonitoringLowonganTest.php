<?php

use Laravel\Dusk\Browser;

test('Lowongan muncul di Monitoring setelah disetujui', function () {
    $this->browse(function (Browser $browser) {
        // Step 1: Login
        $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk')
                ->pause(1000)
                ->assertSee('LOWONGAN')

                // Step 2: Ke halaman Approval dan setujui 1 lowongan
                ->clickLink('LOWONGAN')
                ->pause(1000)
                ->assertPathIs('/admin/lowongan/approval')
                ->assertSee('Lowongan yang Menunggu Persetujuan')
                ->press('#btn-approve') 
                ->pause(1000)
                ->assertSee('Lowongan berhasil disetujui')

                // Step 3: Ke halaman Monitoring
                ->clickLink('MONITORING')
                ->pause(1000)
                ->assertPathIs('/admin/monitoring/mahasiswa')
                ->pause(1000)
                ->visit('/admin/monitoring/lowongan')
                ->assertPathIs('/admin/monitoring/lowongan')

                // Step 4: Verifikasi bahwa lowongan muncul
                ->assertSee('Aktif')
                ->assertSee('PERUSAHAAN');
    });
});

test('Lowongan Non-Aktif karena tenggatnya telah berakhir', function () {
    $this->browse(function (Browser $browser) {
        // Asumsi sudah login atau login ulang jika sesi kadaluarsa
        $browser->visit('/admin/monitoring/lowongan') // Ganti dengan route yang sesuai
                ->assertSee('STATUS')
                ->assertSee('Non Aktif'); 
    });
});