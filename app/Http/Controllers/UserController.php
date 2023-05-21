<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
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
            $user = UserService::saveUser($request->all());

            return response()->json([
                'status' => 201,
                'message' => __('messages.created'),
                'user' => UserService::getUsers($user->id)
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
