

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CarModel;
use App\Models\Color;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarModel>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = CarModel::inRandomOrder()->first();
        if (!$model) {
            $model = CarModel::factory()->create();
        }
        $color = Color::inRandomOrder()->first();
        if (!$color) {
            $color = Color::factory()->create();
        }
        $user = User::inRandomOrder()->first();
        if (!$user) {
            $user = User::factory()->create();
        }
        $yearNow = (int) date('Y');
        return [
            'model_id' => $model->id,
            'year_production' => $this->faker->numberBetween($yearNow- 30, $yearNow),
            'mileage' => $this->faker->numberBetween(0, 10000),
            'color_id' => $color->id,
            'user_id' => $user->id
        ];
    }
}
