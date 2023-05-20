<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UsersLocation;
use App\Services\StateService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function get(int $userId = null): JsonResponse
    {
        return response()->json([
            'status' => 201,
            'user' => UserService::getUsers($userId)
        ], 201);
    }

    public function store(StoreUserRequest $request): JsonResponse
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
                'message' => __('messages.created'),
                'user' => UserService::getUsers($userId)
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
