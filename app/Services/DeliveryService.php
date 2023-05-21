<?php

namespace App\Services;

use App\Models\Delivery;
use Carbon\Carbon;

class DeliveryService
{
    public static function setDeliveryFinishedBecauseWeArePretendingAllTheProcessIsDone(): bool
    {
        return true;
    }

    public static function getDelivery(string $deliveryId = null): Object
    {
        $relations = [
            'user',
            'car.model',
            'car.model.type',
            'car.state'
        ];

        if (isset($deliveryId) && !empty($deliveryId)) {
            return Delivery::where('id', $deliveryId)->with($relations)->get();
        }

        if (AuthService::checkIfLoggedUserIsAdmin()) {
            return Delivery::with($relations)->completed()->get();
        }

        return Delivery::where('user_id', auth()->user()->id)->with($relations)->completed()->get();
    }

    public static function calculateDaysOfDelivery(string $startDate, int $deadline): Object
    {
        $startDate = Carbon::create($startDate);
        return $startDate->addDays($deadline);
    }

    public static function generateDeliveryRequestPayload(array $request, array $schedule): array
    {
        return [
            'accepts_the_proposed_schedule' => true,
            'car_located_id' => $request['car_located_id'],
            'delivery_location_code' => $request['delivery_location_code'],
            'delivery_deadline_in_days' => $schedule['estimated_due']['delivery_due'],
            'delivery_start_date' => $schedule['delivery_start_date'],
        ];
    }
}
