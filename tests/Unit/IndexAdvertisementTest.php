<?php

namespace Tests\Unit;

use Tests\TestCase;

class IndexAdvertisementTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->getJson('/api/advertisements');

        $response->assertStatus(200)
            ->assertJson([
                "data" => $response->json()['data'],
                "links" => $response->json()['links'],
                "meta" => $response->json()['meta'],
                "status" => $response->json()['status'],
            ]);
    }

}
