<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class SectionMonitoringTest extends DuskTestCase
{
    #[Test]
    public function admin_can_see_monitoring_summary_section()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk')
                ->waitForLocation('/admin/pengguna')
                ->click('@sidebar-monitoring')
                ->pause(3000)
                ->assertSee('Peserta Magang')
                ->assertSee('Lowongan Magang Aktif')
                ->assertSee('Peserta Telah Lulus')
                ->screenshot('monitoring-section');
        });
    }
}
