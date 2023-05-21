<?php

namespace App\Http\Controllers;

use App\Models\Car;

class CarController extends Controller
{
    public function get()
    {
        return response()->json([
            'cars' => Car::with(['type', 'location.state'])->get()
        ], 200);
    }
}
