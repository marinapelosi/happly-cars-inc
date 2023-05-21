<?php

namespace App\Services;

use App\Exceptions\OnlyAdminAllowedException;
use App\Models\State;
use App\Models\User;

class StateService
{
    public static function getStateByCode(string $code): Object
    {
        return State::where('code', $code)->first();
    }

    public static function setCityStateField(string $city, string $code): string
    {
        return $city.', '.$code;
    }

    public static function setLatitudeLongitude(string $latitude, string $longitude): array
    {
        return [
            'latitude'  => $latitude,
            'longitude' => $longitude
        ];
    }
}
