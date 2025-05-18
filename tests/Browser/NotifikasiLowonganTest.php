<?php

use Laravel\Dusk\Browser;

test('Mentor dapat login', function () {
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

test('Mentor menambahkan lowongan dan melihat notifikasi', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/mentor/lowongan')
            ->press('TAMBAH LOWONGAN')
            ->pause(1000)

            ->waitFor('#nama_posisi', 5)

            ->type('#nama_posisi', 'Front end developer')
            ->type('#tanggal_lowongan', '10-05-2025')
            ->type('#deskripsi_pekerjaan', 'Front end developer adalah pengembang...')
            ->type('#jumlah_kuota', '10')
            ->type('#durasi_magang', '5 bulan')
            ->type('#persyaratan', '- Mahasiswa/mahasiswi jurusan Sistem Informasi')

            ->press('Simpan & Publikasikan')
            ->pause(2000)

            ->assertSee('Lowongan Sedang Ditinjau');
    });
});