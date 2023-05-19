<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class UsersLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => DB::table('users')->where('is_admin', false)->inRandomOrder()->first()->id,
            'state_id' => DB::table('states')->inRandomOrder()->first()->id,
            'current' => $this->faker->boolean()
        ];
    }
}
