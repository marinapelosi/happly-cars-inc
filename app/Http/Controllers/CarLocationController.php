<?php

namespace App\Http\Controllers;

use App\Models\CarLocation;

class CarLocationController extends Controller
{
    public function getAvailableCars()
    {
        return response()->json([
            'status' => 200,
            'cars' => CarLocation::with(['car', 'location'])
                ->available()
                ->get()
        ]);
    }

    public function getUnavailableCars()
    {
        return response()->json([
            'status' => 200,
            'cars' => CarLocation::with(['car', 'location'])
                ->unavailable()
                ->get()
        ]);
    }
}
