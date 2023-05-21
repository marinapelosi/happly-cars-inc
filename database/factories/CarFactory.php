<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'car_type_id' => DB::table('car_types')->inRandomOrder()->first()->id,
            'display_name' => $this->faker->lastName(),
            'key_name' => $this->faker->year()
        ];
    }
}
