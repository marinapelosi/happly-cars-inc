<?php

namespace Database\Factories;

use App\Models\CarLocation;
use App\Models\State;
use App\Models\User;
use App\Models\UsersLocation;
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
        $userId = User::where('is_admin', false)->inRandomOrder()->first()->id;
        $stateIdToUser = State::first()->id;
        $stateIdToCar = State::first()->id;

        if (!$userCurrentLocation = UsersLocation::where('user_id', $userId)->where('current', true)->first()) {
            $userCurrentLocation = UsersLocation::create([
                'user_id' => $userId,
                'state_id' => $stateIdToUser,
                'current' => true
            ]);
        }

        return [
            'user_id' => $userId,
            'car_located_id' => CarLocation::factory()->create([
                'car_id' => DB::table('cars')->inRandomOrder()->first()->id,
                'state_id' => $stateIdToCar,
                'available' => false
            ])->id,
            'delivery_location_id' => $stateIdToUser,
            'delivered' => $this->faker->boolean(),
            'delivery_deadline_in_days' => 1,
            'delivery_start_date' => now(),
            'delivery_finish_date' => now()
        ];
    }
}
