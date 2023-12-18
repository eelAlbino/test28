<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Color;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Получение списка автомобилей для определенного пользователя
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        // Создаем несколько машин для пользователя
        Car::factory(15)->create([
            'user_id' => $user->id
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->token
        ])->get('/api/cars');

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

    /**
     * Создание авто для пользователя
     */
    public function testStore()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        $carData = Car::factory()->make([
            'user_id' => $user->id
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->token
        ])->postJson('/api/cars', $carData);

        $response->assertStatus(201)->assertJson([
            'success' => true,
            'data' => [
                'elem' => $carData->toArray()
            ]
        ]);

        $this->assertDatabaseHas('cars', $carData->toArray());
    }

    /**
     * Обновление авто пользователя
     */
    public function testUpdate(array $params)
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        $modelOld = CarModel::factory()->create();
        $colorOld = Color::factory()->create();
        $car = Car::factory()->create([
            'user_id' => $userOld->id,
            'model_id' => $modelOld->id,
            'color_id' => $colorOld->id,
        ]);
        $model = CarModel::factory()->create();
        $color = CarModel::factory()->create();
        $updateDate = [
            'model_id' => $model->id,
            'color_id' => $color->id,
            'mileage' => $car->mileage - 1,
            'year_production' => $car->year_production - 1,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->token
        ])->putJson('/api/cars/' . $car->id, $updatedData);
        $response->assertStatus(200)->assertJson([
            'success' => true,
            'data' => [
                'elem' => $carData->toArray()
            ]
        ]);
        $this->assertDatabaseHas('cars', $carData->toArray());
    }

    /**
     * Удаление авто пользователя
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        $car = Car::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token->token
        ])->deleteJson('/api/cars/' . $car->id);
        $response->assertStatus(204)->assertJson([
            'success' => true
        ]);
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}
