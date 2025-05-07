<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DetailLowonganTest extends DuskTestCase
{
    public function test_admin_can_see_detail_lowongan()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@telship.com')
                    ->type('password', 'telship999')
                    ->press('Masuk')
                    ->visit('admin/lowongan/approval')
                    ->click('.d-flex.align-items-center.justify-content-between')
                    ->assertSee('UI/UX Designer')
                    ->screenshot('detail_lowongan-admin');
        });
    }
}