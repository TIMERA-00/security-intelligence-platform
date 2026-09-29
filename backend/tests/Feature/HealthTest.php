<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthTest extends TestCase
{
    public function test_health_endpoint_returns_ok_when_database_is_available(): void
    {
        $response = $this->getJson('/api/health');

        $response
            ->assertOk()
            ->assertJson([
                'status' => 'ok',
                'database' => 'connected',
            ]);
    }

    public function test_health_endpoint_returns_503_when_database_is_unavailable(): void
    {
        config([
            'database.default' => 'missing',
        ]);

        $response = $this->getJson('/api/health');

        $response
            ->assertStatus(503)
            ->assertJson([
                'status' => 'error',
                'database' => 'unavailable',
            ]);
    }
}
