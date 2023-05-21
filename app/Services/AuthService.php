<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function validate(Request $request): array
    {
        return $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public static function checkPassword(User $user, string $password)
    {
        if (!$user || !Hash::check($password, $user->password)) {
            return response([
                'msg' => __('auth.password')
            ], 401);
        }
    }

    public static function createApiToken(User $user): void
    {
        $user->createToken('apiToken')->plainTextToken;
    }

    public static function checkIfLoggedUserIsAdmin(): bool
    {
        return (auth()->user()->is_admin == true);
    }
}
