<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Exception\TimeoutException;

class SearchFailedTest extends DuskTestCase
{
    protected function loginAsAdmin(Browser $browser)
    {
        $browser->visit('/login')
                ->waitFor('input[type="email"]')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk');
    }

    /** @test */
    public function admin_cannot_find_nonexistent_student()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $nonexistentStudent = 'TES GAGAL';

            $browser->visit('/admin/pengguna')
                    ->waitFor('input.form-control', 5)
                    ->type('input.form-control', $nonexistentStudent)
                    ->press('Cari')
                    ->waitForText('Tidak ada data mahasiswa', 5)
                    ->assertSee('Tidak ada data mahasiswa')
                    ->screenshot('search_student_failed');
        });
    }

    /** @test */
    public function admin_cannot_find_nonexistent_mentor()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $nonexistentMentor = 'TES GAGAL';

            $browser->visit('/admin/mentor')
                    ->waitFor('input.form-control', 5)
                    ->type('input.form-control', $nonexistentMentor)
                    ->press('Cari')
                    ->waitForText('Tidak ada data mentor', 5)
                    ->assertSee('Tidak ada data mentor')
                    ->screenshot('search_mentor_failed');
        });
    }

    /** @test */
    public function admin_cannot_find_nonexistent_partner()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $nonexistentPartner = 'TES GAGAL';

            $browser->visit('/admin/mitra')
                    ->waitFor('input.form-control', 5)
                    ->type('input.form-control', $nonexistentPartner)
                    ->press('Cari')
                    ->waitForText('Tidak ada data mitra', 5)
                    ->assertSee('Tidak ada data mitra')
                    ->screenshot('search_partner_failed');
        });
    }
}
