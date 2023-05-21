<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\User;
use App\Services\DeliveryService;
use App\Services\GeoLocation\LocationFinderService;
use Illuminate\Http\JsonResponse;
use Spatie\Geocoder\Geocoder;

class LocationController extends Controller
{
    private $localizationFinder;
    public function __construct(LocationFinderService $localizationFinder)
    {
        $this->localizationFinder = $localizationFinder;
    }

    public function get()
    {
        $this->localizationFinder->getLocalizationByAddress("New York, NY");
    }
}
