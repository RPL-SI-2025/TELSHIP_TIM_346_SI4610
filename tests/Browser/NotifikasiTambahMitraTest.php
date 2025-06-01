<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotifikasiTambahMitraTest extends DuskTestCase
{
    public function test_admin_can_add_mitra_and_see_success_modal()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'admin@telship.com')
                ->type('password', 'telship999')
                ->press('Masuk')
                ->waitForLocation('/admin/pengguna')

                ->visit('/admin/pengguna')
                ->clickLink('MITRA')
                ->waitForText('Tambahkan Mitra')
                ->press('Tambahkan Mitra')

                ->whenAvailable('#addModal', function (Browser $modal) {
                    $modal->type('nama_perusahaan', 'PT United Tractors')
                        ->type('email', 'info@ut.co.id')
                        ->type('telepon', '089655718504')
                        ->type('alamat', 'Cakung')
                        ->type('deskripsi_perusahaan', 'Perusahaan Alat Berat')
                        ->type('link_website', 'https://www.unitedtractors.com/')
                        ->press('Tambah Mitra');
                })

                ->waitForText('ID Perusahaan Telah Ditambahkan!', 5)
                ->assertSee('ID Perusahaan Telah Ditambahkan!')
                ->assertSee('Kembali')
                ->screenshot('notifikasi-tambah-mitra-success');
        });
    }
}
