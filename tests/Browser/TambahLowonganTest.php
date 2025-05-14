<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TambahLowonganTest extends DuskTestCase
{
    public function testMentorDapatLogin()
    {
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
    }

    public function testMentorMenambahkanLowongan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/mentor/lowongan')
                ->press('TAMBAH LOWONGAN')
                ->pause(1000)
                ->waitFor('#nama_posisi', 5)
                ->type('#nama_posisi', 'Data Analyst')
                ->type('#tanggal_lowongan', '15-09-2025')
                ->type('#deskripsi_pekerjaan', 'Magang')
                ->type('#jumlah_kuota', '7')
                ->type('#durasi_magang', '1 Tahun')
                ->type('#persyaratan', 'Portofolio')
                ->press('Simpan & Publikasikan');
        });
    }
}