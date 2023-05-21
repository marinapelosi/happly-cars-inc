<?php

namespace App\Services;

use App\Models\CarLocation;

class CarService
{
    public static function getCar(int $carLocatedId): Object
    {
        return CarLocation::where('id', $carLocatedId)->with('model', 'model.type', 'state')->first();
    }

    public static function setCarUnavailable(int $carLocatedId): void
    {
        $car = CarLocation::find($carLocatedId);
        $car->available = false;
        $car->save();
    }
}
