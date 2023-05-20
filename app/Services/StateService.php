<?php

namespace App\Services;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\State;
use App\Models\User;

class StateService
{
    public static function getStateByCode(string $code): Object
    {
        return State::where('code', $code)->first();
    }
}
