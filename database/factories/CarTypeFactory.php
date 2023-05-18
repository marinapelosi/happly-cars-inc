<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'display_name' => $this->faker->lastName(),
            'key_name' => $this->faker->shuffleString(),
        ];
    }
}
