<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminMonitoringMahasiswaTest extends DuskTestCase
{
    public function test_admin_can_view_monitoring_mahasiswa_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login') // atau sesuaikan dengan tombol login
                    ->type('email', 'admin@telship.com')
                    ->type('password', 'telship999')
                    ->press('Masuk')
                    ->pause(2000)
                    ->assertPathIs('/admin/pengguna')
                    ->click('@sidebar-monitoring') // tambahkan dusk attribute
                    ->pause(1000)
                    ->assertPathIs('/admin/monitoring/mahasiswa')
                    ->assertSee('MAHASISWA')
                    ->assertSee('STATUS')
                    ->screenshot('monitoring-mahasiswa');
        });
    }
}
