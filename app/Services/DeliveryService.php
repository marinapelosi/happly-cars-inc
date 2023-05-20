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

    public static function getDelivery(string $deliveryId): Object
    {
        return Delivery::where('id', $deliveryId)->with([
            'user.location.state',
            'location',
            'car.model',
            'car.model.type',
            'car.state'
        ])->get();
    }

    public static function getDeliveries(string $type = null): Object
    {
        $with = [
            'user.location.state',
            'location',
            'car.model',
            'car.model.type',
            'car.state'
        ];

        if (isset($type) && $type === 'requested') {
            return Delivery::with($with)->requested()->get();
        }

        return Delivery::with($with)->completed()->get();
    }

    public static function calculateDaysOfDelivery(string $startDate, int $deadline): Object
    {
        $startDate = Carbon::create($startDate);
        return $startDate->addDays($deadline);
    }
}
