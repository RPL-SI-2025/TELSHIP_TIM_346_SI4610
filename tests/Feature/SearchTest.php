<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Exception\TimeoutException;

class SearchTest extends DuskTestCase
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
    public function admin_can_search_specific_student()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $studentName = 'Christian Bryan Seputra';

            try {
                $browser->visit('/admin/pengguna')
                        ->waitFor('input.form-control', 5)
                        ->type('input.form-control', $studentName)
                        ->press('Cari')
                        ->waitForText($studentName, 5)
                        ->assertSee($studentName)
                        ->screenshot('search_success');
            } catch (TimeoutException $e) {
                $browser->screenshot('search_failed');
                throw new \Exception("Nama '{$studentName}' tidak ditemukan.");
            }
        });
    }

    /** @test */
    public function admin_can_search_specific_mentor()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $mentorName = 'Alvin Pratama';

            try {
                $browser->visit('/admin/mentor')
                        ->waitFor('input.form-control', 5)
                        ->type('input.form-control', $mentorName)
                        ->press('Cari')
                        ->waitForText($mentorName, 5)
                        ->assertSee($mentorName)
                        ->screenshot('search_mentor_success');
            } catch (TimeoutException $e) {
                $browser->screenshot('search_mentor_failed');
                throw new \Exception("Nama mentor '{$mentorName}' tidak ditemukan.");
            }
        });
    }

    /** @test */
    public function admin_can_search_specific_partner()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $partnerName = 'XL Axiata';

            try {
                $browser->visit('/admin/mitra')
                        ->waitFor('input.form-control', 5)
                        ->type('input.form-control', $partnerName)
                        ->press('Cari')
                        ->waitForText($partnerName, 5)
                        ->assertSee($partnerName)
                        ->screenshot('search_partner_success');
            } catch (TimeoutException $e) {
                $browser->screenshot('search_partner_failed');
                throw new \Exception("Nama mitra '{$partnerName}' tidak ditemukan.");
            }
        });
    }
}