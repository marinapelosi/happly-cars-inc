<?php

namespace Services\Geolocation;

use App\Services\GeoLocation\LocationFinderService;
use Geocoder\Geocoder;
use GuzzleHttp\Client;
use Tests\TestCase;

class LocationFinderServiceTest extends TestCase
{
    private $locationFinderSevice;
    private $geocoder;

    public function setUp(): void
    {
        parent::setUp();
        $this->geocoder = \Mockery::mock(Geocoder::class);
        $this->locationFinderSevice = new LocationFinderService(new Client());
    }

    public function testShouldFindLocationByAddressSuccessfully()
    {
        $this->geocoder->shouldReceive('getCoordinatesForAddress')->andReturn([]);
        $this->assertIsArray($this->locationFinderSevice->getLocalizationByAddress('New York, NY'));
    }
}
