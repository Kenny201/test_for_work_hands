<?php

namespace Tests\Unit;

use App\Models\Advertisement;
use Tests\TestCase;

class ShowAdvertisementTest extends TestCase
{
    public function testShow()
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->getJson('/api/advertisements/'.$advertisement->id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $response->json()['data']['id'],
                    'name' => $response->json()['data']['name'],
                    'price' => $response->json()['data']['price'],
                ],
            ]);
    }
}
