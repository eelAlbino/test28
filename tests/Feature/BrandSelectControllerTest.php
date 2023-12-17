<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;

class BrandSelectControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Получения списка брендов.
     * Создаются 15 брендов, выводятся первые 10 и их количество
     */
    public function testSelect(): void
    {
        $resSelect = Brand::factory(15)->create();
        $response = $this->get('/api/brand');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                'items' => $resSelect->take(10)->toArray(),
                'total' => 15,
                'offset' => 0
            ]
        ]);
    }
}
