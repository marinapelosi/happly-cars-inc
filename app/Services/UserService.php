<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getUsers(int $userId = null): Object
    {
        $relations = [
            'current_location',
            'deliveries.car.model',
            'deliveries.car.model.type',
            'deliveries.car.state'
        ];

        if (isset($userId) && !empty($userId)) {
            return User::where('id', $userId)->with($relations)->costumer()->get();
        }

        return User::with($relations)->orderBy('created_at', 'desc')->get();
    }
}
