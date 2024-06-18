<?php

namespace Tests\Unit;

use Tests\TestCase;

class CreateAdvertisementTest extends TestCase
{

    public function testCreateAdvertisement()
    {
        $response = $this->postJson('/api/advertisements', [
            'name' => 'Filon',
            'description' => 'Filon',
            'images' => ["storage/old ip.jpg","storage/page.jpg","storage/Untitled.jpg"],
            'price' => '10000',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Объявление cоздано успешно',
                'data' => [
                    'name' => 'Filon',
                    'image' => 'storage/old ip.jpg',
                    'price' => '10000',
                ]
            ]);
    }
}
