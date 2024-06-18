<?php

namespace Tests\Unit;

use App\Models\Advertisement;
use Tests\TestCase;

class ShowFieldsAdvertisementTest extends TestCase
{
    public function testAdvertisementsShowFields()
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->getJson('/api/advertisements/'.$advertisement->id.'/fields');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'description' => $response->json()['data']['description'],
                    'images' => $response->json()['data']['images'],
                ],
            ]);
    }
}
