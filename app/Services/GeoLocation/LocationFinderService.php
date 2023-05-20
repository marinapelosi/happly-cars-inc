<?php

namespace App\Services\GeoLocation;

use GuzzleHttp\Client;
use Spatie\Geocoder\Geocoder;

class LocationFinderService
{
    private $client;

    private $geocoder;

    public function __construct(Client $client)
    {

        $this->client = $client;

        $this->geocoder = new Geocoder($client);

        $this->geocoder->setApiKey(env('GOOGLE_MAPS_API_KEY'));

        $this->geocoder->setCountry('US');
    }

    public function getLocalizationByAddress(string $address): array
    {
        return $this->geocoder->getCoordinatesForAddress($address);
    }
}
