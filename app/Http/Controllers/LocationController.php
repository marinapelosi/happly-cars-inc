<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\User;
use App\Services\DeliveryService;
use Illuminate\Http\JsonResponse;
use Spatie\Geocoder\Geocoder;

class LocationController extends Controller
{
    public function get()
    {
        $address = '275 N Main St Ephraim UT 84627-1107';
//        $result = app('geocoder')->getCoordinatesForAddress('New York')->get();
//        dd($result);
//        $coordinates = $result[0]->getCoordinates();
//        $lat = $coordinates->getLatitude();
//        $long = $coordinates->getLongitude();
//        dd($lat, $long);

        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(env('GOOGLE_MAPS_API_KEY'));

        $geocoder->setCountry('US');

        dd($geocoder->getCoordinatesForAddress('New York'));

        /*
          This function returns an array with keys
          "lat" =>  37.331741000000001
          "lng" => -122.0303329
          "accuracy" => "ROOFTOP"
          "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, USA",
          "viewport" => [
            "northeast" => [
              "lat" => 37.3330546802915,
              "lng" => -122.0294342197085
            ],
            "southwest" => [
              "lat" => 37.3303567197085,
              "lng" => -122.0321321802915
            ]
          ]
        */
    }
}
