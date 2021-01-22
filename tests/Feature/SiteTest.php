<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    public function test_home_status()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
