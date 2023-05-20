<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarController extends Controller
{
    public function getCarsWithLocation()
    {
        return response()->json([
            'cars' => Car::with(['type', 'location'])->get()
        ], 200);
    }
}
