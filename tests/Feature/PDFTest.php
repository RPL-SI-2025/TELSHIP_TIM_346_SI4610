<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Exception\TimeoutException;

class PDFTest extends DuskTestCase
{
    protected function loginAsAdmin(Browser $browser)
    {
        $browser->visit('/login')
                ->waitFor('input[type="email"]')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk');
    }

    public function test_can_export_pdf()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
    
            $browser->visit('/admin/pengguna')
                    ->pause(1000) // tunggu page selesai render
                    ->clickLink('Export PDF') // klik berdasarkan teks tombol
                    ->pause(2000) // beri waktu download jika auto
                    ->screenshot('export_pdf_clicked') // bukti visual
                    ->assertPathIs('/admin/pengguna'); // pastikan tidak error/berpindah
        });
    }
}
    