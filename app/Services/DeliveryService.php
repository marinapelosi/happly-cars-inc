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
        return Delivery::where('id', $deliveryId)->with(['user', 'location', 'car'])->get();
    }

    public static function calculateDaysOfDelivery(string $startDate, int $deadline): Object
    {
        $startDate = Carbon::create($startDate);
        return $startDate->addDays($deadline);
    }
}
