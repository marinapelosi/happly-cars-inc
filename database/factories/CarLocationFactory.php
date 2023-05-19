<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CarLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'car_id' => DB::table('car_types')->inRandomOrder()->first()->id,
            'state_id' => DB::table('states')->inRandomOrder()->first()->id,
            'available' => $this->faker->boolean()
        ];
    }
}
