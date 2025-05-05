<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group pengguna
 */

class PenggunaTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user (admin) and a sample student
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Mahasiswa::factory()->create([
            'user_id' => $user->id,
            'nim' => '123456789',
            'nama_lengkap' => 'John Doe',
            'email' => 'john.doe@example.com',
            'jurusan' => 'Informatika',
            'no_hp' => '081234567890',
        ]);
    }

    /**
     * Test the student list page loads and displays data.
     */
    public function testStudentListPageLoads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/pengguna')
                    ->assertSee('PENGGUNA')
                    ->assertSee('MAHASISWA')
                    ->assertSee('MENTOR')
                    ->assertSee('MITRA')
                    ->assertSee('John Doe')
                    ->assertSee('123456789')
                    ->assertSee('john.doe@example.com')
                    ->assertSee('Informatika')
                    ->assertSee('081234567890');
        });
    }

    /**
     * Test editing a student's data.
     */
    public function testEditStudent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/pengguna')
                    ->click('.edit-btn') // Click the edit button
                    ->waitFor('#editModal') // Wait for the edit modal to appear
                    ->assertSee('Edit Mahasiswa')
                    ->type('#edit-nim', '987654321')
                    ->type('#edit-nama_lengkap', 'Jane Doe')
                    ->type('#edit-email', 'jane.doe@example.com')
                    ->type('#edit-jurusan', 'Sistem Informasi')
                    ->type('#edit-no_hp', '089876543210')
                    ->click('.btn-danger') // Click "Simpan Perubahan"
                    ->waitForText('Data mahasiswa berhasil diperbarui')
                    ->assertSee('Data mahasiswa berhasil diperbarui')
                    ->refresh()
                    ->assertSee('Jane Doe')
                    ->assertSee('987654321')
                    ->assertSee('jane.doe@example.com')
                    ->assertSee('Sistem Informasi')
                    ->assertSee('089876543210');
        });
    }

    /**
     * Test deleting a student.
     */
    public function testDeleteStudent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/pengguna')
                    ->click('.delete-btn') // Click the delete button
                    ->waitFor('#deleteModal') // Wait for the delete modal to appear
                    ->assertSee('Konfirmasi Hapus')
                    ->click('#confirmDelete') // Click "Hapus"
                    ->waitForText('Data mahasiswa berhasil dihapus')
                    ->assertSee('Data mahasiswa berhasil dihapus')
                    ->refresh()
                    ->assertSee('Tidak ada data mahasiswa');
        });
    }

    /**
     * Test error handling when editing with invalid data.
     */
    public function testEditStudentWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/pengguna')
                    ->click('.edit-btn')
                    ->waitFor('#editModal')
                    ->type('#edit-email', 'invalid-email') // Invalid email
                    ->click('.btn-danger')
                    ->waitForText('Gagal memperbarui data')
                    ->assertSee('Gagal memperbarui data');
        });
    }
}