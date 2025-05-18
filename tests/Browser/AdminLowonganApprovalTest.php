<?php

use Laravel\Dusk\Browser;

test('View Approval Page and Approve a Job Post', function () {
    $this->browse(function (Browser $browser) {
        // Tes 1: Login terlebih dahulu
        $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk')
                ->pause(2000)
                ->assertSee('LOWONGAN')

                // Tes 2: Klik lowongan pertama (membuka modal)
                ->clickLink('LOWONGAN') // Klik card pertama
                ->pause(1000)
                ->assertPathIs('/admin/lowongan/approval')
                ->assertSee('Lowongan yang Menunggu Persetujuan')

                // Tes 3: Klik card pertama untuk membuka modal detail
                ->click('.lowongan-card')
                ->pause(1000)
                ->assertVisible('#detailModal')
                ->assertSeeIn('#detailModalLabel', 'Detail Lowongan')

                // Tes 4: Klik tombol 'Tutup' di modal
                ->press('Tutup')
                ->pause(1000)

                // Tes 5: Klik tombol 'Setujui'
                ->click('#btn-approve')
                ->pause(2000)
                ->assertSee('Lowongan berhasil disetujui'); // Atau bisa juga assert bahwa lowongan tersebut hilang

    });
});

test('Reject a Job Post from Approval Page', function () {
    $this->browse(function (Browser $browser) {
        // Asumsi sudah login atau login ulang jika sesi kadaluarsa
        $browser->visit('/admin/lowongan/approval') // Ganti dengan route yang sesuai
                ->assertSee('Lowongan yang Menunggu Persetujuan')

                // Tes 5: Klik tombol 'Tolak' untuk lowongan pertama
                ->click('#btn-reject')
                ->pause(2000)
                ->assertSee('Lowongan berhasil ditolak'); // Bisa diganti untuk assert flash message sukses
    });
});
