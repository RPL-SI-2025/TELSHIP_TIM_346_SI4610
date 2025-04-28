<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Jobs;

class JobApprovalControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function halaman_index_menampilkan_lowongan_pending()
    {
        $job = Jobs::create([
            'title' => 'Frontend Developer',
            'company' => 'PT Keren',
            'status' => 'pending'
        ]);

        $response = $this->get(route('lowongan.index'));

        $response->assertStatus(200);
        $response->assertSee('Frontend Developer');
        $response->assertSee('PT Keren');
    }

    /** @test */
    public function dapat_menyetujui_lowongan()
    {
        $job = Jobs::create([
            'title' => 'Data Analyst',
            'company' => 'PT Hebat',
            'status' => 'pending'
        ]);

        $response = $this->post(route('lowongan.approve', $job->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Lowongan disetujui.');

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'status' => 'approved'
        ]);
    }

    /** @test */
    public function dapat_menolak_lowongan()
    {
        $job = Jobs::create([
            'title' => 'UI/UX Designer',
            'company' => 'PT Kreatif',
            'status' => 'pending'
        ]);

        $response = $this->post(route('lowongan.reject', $job->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Lowongan ditolak.');

        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'status' => 'rejected'
        ]);
    }
}
