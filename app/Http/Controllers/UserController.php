<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UsersLocation;
use App\Services\StateService;
use App\Services\UserService;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        try {
            $userId = User::create($request->all())->id;
            $state = StateService::getStateByCode($request->input('state'));
            UsersLocation::create([
                'user_id' => $userId,
                'state_id' => $state->id
            ]);

            return response()->json([
                'status' => 201,
                'message' => __('messages.created')
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
