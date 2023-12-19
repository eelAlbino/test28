<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    // Пользователь, к которому привязаны тестовые данные
    private ?int $userID = null;

    // Токен для авторизации
    private ?string $authToken = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUserParams();
    }

    /**
     * Установка параметров тестового пользователя
     */
    private function setUserParams(): void
    {
        $pass = 'pass123';
        $userParams = [
            'email' => 'test@test.ru',
            'password' => bcrypt($pass)
        ];
        $this->artisan('passport:install');
        $user = User::factory()->create($userParams);
        $oauthClient = DB::table('oauth_clients')->where('provider', 'users')->first();
        $response = $this->postJson('/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oauthClient->id,
            'client_secret' => $oauthClient->secret,
            'username' => $userParams['email'],
            'password' => $pass
        ]);
        $this->userID = $user->id;
        $this->authToken = $response->json('access_token');
    }
    /**
     * Получение списка автомобилей для определенного пользователя
     */
    public function testIndex()
    {
        // Создаем несколько машин для пользователя
        $resSelect = Car::factory(15)->create([
            'user_id' => $this->userID
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
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
        $carData = Car::factory()->make([
            'user_id' => $this->userID
        ])->toArray();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->postJson('/api/cars', $carData);

        $response->assertStatus(201)->assertJson([
            'success' => true,
            'data' => [
                'elem' => $carData
            ]
        ]);

        $this->assertDatabaseHas('cars', $carData);
    }

    /**
     * Обновление авто пользователя
     */
    public function testUpdate()
    {
        $modelOld = CarModel::factory()->create();
        $colorOld = Color::factory()->create();
        $car = Car::factory()->create([
            'user_id' => $this->userID,
            'model_id' => $modelOld->id,
            'color_id' => $colorOld->id,
        ]);
        $model = CarModel::factory()->create();
        $color = Color::factory()->create();
        $updateDate = [
            'model_id' => $model->id,
            'color_id' => $color->id,
            'mileage' => $car->mileage - 1,
            'year_production' => $car->year_production - 1,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->putJson('/api/cars/' . $car->id, $updateDate);
        $response->assertStatus(200)->assertJson([
            'success' => true,
            'data' => [
                'elem' => $updateDate
            ]
        ]);
        $this->assertDatabaseHas('cars', $updateDate);
    }

    /**
     * Удаление авто пользователя
     */
    public function testDestroy()
    {
        $car = Car::factory()->create([
            'user_id' => $this->userID,
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken
        ])->deleteJson('/api/cars/' . $car->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }
}
