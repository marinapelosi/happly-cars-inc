<?php

namespace Database\Factories;

use App\Models\CarLocation;
use App\Models\State;
use App\Models\User;
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
        $user = User::costumer()->inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'car_located_id' => CarLocation::factory()->create([
                'car_id' => DB::table('cars')->inRandomOrder()->first()->id,
                'state_id' => State::first()->id,
                'available' => false
            ])->id,
            'delivery_location' => json_encode(State::where('id', $user->location_id)->first()),
            'delivered' => $this->faker->boolean(),
            'delivery_deadline_in_days' => 1,
            'delivery_start_date' => now(),
            'delivery_finish_date' => now()
        ];
    }
}
