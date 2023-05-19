<?php

namespace Database\Factories;

use App\Models\CarLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class DeliveryFactory extends Factory
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
            'car_located_id' => CarLocation::factory()->create([
                'car_id' => DB::table('car_types')->inRandomOrder()->first()->id,
                'state_id' => DB::table('states')->inRandomOrder()->first()->id,
                'available' => false
            ]),
            'delivery_location_id' => DB::table('states')->first()->id,
            'delivered' => $this->faker->boolean()
        ];
    }
}
