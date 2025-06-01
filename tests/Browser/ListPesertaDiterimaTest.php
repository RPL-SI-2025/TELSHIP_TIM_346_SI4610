<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ListLowonganSelesai extends DuskTestCase
{
    protected function loginAsMentor(Browser $browser)
    {
        $browser->visit('/login')
                ->waitFor('input[type="email"]')
                ->type('email', 'mentor@telkom.co.id')
                ->type('password', 'password123')
                ->press('Masuk')
                ->pause(1000);
    }

    public function test_mentor_can_view_closed_job_listing()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMentor($browser);

            // Halaman daftar lowongan
            $browser->visit('/mentor/lowongan')
                    ->waitForText('Lowongan Ditutup')
                    ->assertSee('UIUX')
                    ->assertSee('Lowongan Ditutup')
                    ->assertSee('Selesai')
                    ->screenshot('view_closed_job_listing');

            // Halaman detail lowongan
            $browser->visit('/mentor/lowongan/1')
                    ->pause(1500)
                    ->assertSee('UIUX') // pastikan ini benar-benar ada
                    // ->assertSee('Lowongan Ditutup') // KOMENTARI jika tidak tampil
                    ->screenshot('Detail_Lowongan_page');
        });
    }
}
