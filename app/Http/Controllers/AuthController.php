<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = AuthService::validate($request);
        $user = UserService::getUserByEmail($loginData['email']);
        AuthService::checkPassword($user, $loginData['password']);
        $token = $user->createToken('apiToken')->plainTextToken;

        return response([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => __('auth.logout')
        ];
    }
}
