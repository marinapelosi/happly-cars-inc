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

        return Delivery::with($relations)->completed()->get();
    }

    public static function calculateDaysOfDelivery(string $startDate, int $deadline): Object
    {
        $startDate = Carbon::create($startDate);
        return $startDate->addDays($deadline);
    }
}
