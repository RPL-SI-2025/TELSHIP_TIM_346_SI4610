<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Exception\TimeoutException;

class ListLowonganSelesai extends DuskTestCase
{
    protected function loginAsMentor(Browser $browser)
    {
        $browser->visit('/login')
                ->waitFor('input[type="email"]')
                ->type('email', 'mentor@telkom.co.id')
                ->type('password', 'password123')
                ->press('Masuk');
    }

    public function test_mentor_can_view_closed_job_listing()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMentor($browser);
    
            $browser->visit('/mentor/lowongan')
                    ->waitForText('Lowongan Ditutup') // Pastikan elemen ini tampil
                    ->assertSee('UIUX')
                    ->assertSee('Lowongan Ditutup')
                    ->assertSee('Selesai') // tombol label merah
                    ->screenshot('view_closed_job_listing');
        });
    }
}
    
    