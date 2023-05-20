<?php

namespace App\Services;

use App\Models\User;
use App\Services\GeoLocation\LocationDistanceService;
use Salman\GeoFence\Service\GeoFenceCalculator;

class ScheduleService
{
    public static function setDeliveryFinishedBecauseWeArePretendingAllTheProcessIsDone(): bool
    {
        return true;
    }

    public static function generateSchedule(array $request): array
    {
        $locationDistanceService = new LocationDistanceService(new GeoFenceCalculator());
        $userId = User::inRandomOrder()->first()->id; // @TODO: colocar o usuário logado aqui
        $user = UserService::getUsers($userId, false);
        $car = CarService::getCar($request['car_located_id']);
        $originLocation = StateService::setLatitudeLongitude($car->state->latitude, $car->state->longitude);
        $deliveryLocation = StateService::setLatitudeLongitude($user->current_location->latitude, $user->current_location->longitude);

        return [
                'origin' => $car->state->capital.', '.$car->state->code,
                'destination' => $user->current_location->capital.', '.$user->current_location->code,
                'delivery_start_date' => now(),
                'estimated_due' => $locationDistanceService->calculateDrivingTime($originLocation, $deliveryLocation),
                'car' => $car,
                'user' => $user,
        ];
    }
}
