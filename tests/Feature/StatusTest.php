<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    /** @test */
    public function it_shows_the_status_page_with_correct_data()
    {
        $response = $this->get('/status'); // Pastikan route /status benar ada

        $response->assertStatus(200);
        $response->assertSee('TELSHIP');
        $response->assertSee('Alexa');
        $response->assertSee('Front-End Developer');
        $response->assertSee('Open Library Telkom University');
        $response->assertSee('Aktif');
    }
}
