<?php

namespace App\Services;

use App\Exceptions\OnlyAdminAllowedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class UserService
{
    public static function getUsers(
        int $userId = null,
        bool $withDeliveries = true
    ): Object {

        $relations = ['current_location'];

        if ($withDeliveries) {
            array_push(
                $relations,
                'deliveries.car.model',
                'deliveries.car.model.type',
                'deliveries.car.state'
            );
        }

        if (isset($userId) && !empty($userId)) {
            return User::where('id', $userId)->with($relations)->first();
        }

        if (AuthService::checkIfLoggedUserIsAdmin()) {
            return User::with($relations)->orderBy('created_at', 'desc')->get();
        }

        return User::where('id', auth()->user()->id)->with($relations)->orderBy('created_at', 'desc')->get();
    }

    public static function getUserByEmail(string $email): object
    {
        $user = User::where('email', $email)->first();
        return self::getUsers($user->id);
    }

    public static function saveUser(array $request): Object
    {
        if (!AuthService::checkIfLoggedUserIsAdmin()) {
            throw new OnlyAdminAllowedException(__('auth.only_admin_error'));
        }

        $stateId = StateService::getStateByCode($request['state'])->id;
        $request['location_id'] = $stateId;
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request);
        AuthService::createApiToken($user);
        return $user;
    }


}
