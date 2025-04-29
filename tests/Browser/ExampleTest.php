<?php

use Laravel\Dusk\Browser;

test('Mentor Can Login and Add Job Posting', function () {
    $this->browse(function (Browser $browser) {
        // Step 1: Login sebagai mentor
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

test('Mentor Add New Job Posting and See Pending Modal', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/mentor/lowongan')
            // Klik tombol pemicu modal berdasarkan teks
            ->press('TAMBAH LOWONGAN')
            ->pause(1000)

            // Tunggu elemen dalam modal muncul (misalnya field nama_posisi)
            ->waitFor('#nama_posisi', 5)

            // Isi form dalam modal
            ->type('#nama_posisi', 'Front end developer')
            ->type('#tanggal_lowongan', '2025-05-01')
            ->type('#deskripsi_pekerjaan', 'Front end developer adalah pengembang...')
            ->type('#jumlah_kuota', '10')
            ->type('#durasi_magang', '5 bulan')
            ->type('#persyaratan', '- Mahasiswa/mahasiswi jurusan Sistem Informasi')

            // Klik tombol submit dalam modal
            ->press('Simpan & Publikasikan')
            ->pause(2000)

            // Pastikan muncul notifikasi atau halaman yang menandakan berhasil
            ->assertSee('Lowongan Sedang Ditinjau'); // sesuaikan jika teks lain
    });
});