<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarController extends Controller
{
    public function getCarsWithLocation()
    {
        return response()->json([
            'status' => 200,
            'cars' => Car::with(['type', 'location'])->get()
        ]);
    }
}
