<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUsersLocationRequest;

class UsersLocationController extends Controller
{
    public function getCostumersWithLocation()
    {
        return response()->json([
            'status' => 200,
            'costumers' => User::with('location')->get()
        ]);
    }
}
