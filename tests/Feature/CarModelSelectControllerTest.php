<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\CarModel;

class CarModelSelectControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Получения списка моделей авто.
     * Создаются 15 элементов, выводятся первые 10 и их количество
     */
    public function testSelect(): void
    {
        $resSelect = CarModel::factory(15)->create();
        $response = $this->get('/api/car-model');

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
