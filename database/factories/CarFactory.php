<?php

namespace Database\Factories;

use App\Models\CarType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'car_type_id' => CarType::factory(),
            'display_name' => $this->faker->lastName(),
            'key_name' => $this->faker->shuffleString()
        ];
    }
}
