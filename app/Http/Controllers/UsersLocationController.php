<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\UsersLocation;
use App\Http\Requests\StoreUsersLocationRequest;
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
