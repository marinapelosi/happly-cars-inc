<?php

namespace Services\Geolocation;

use App\Services\GeoLocation\LocationDistanceService;
use Salman\GeoFence\Service\GeoFenceCalculator;
use Tests\TestCase;

class LocationDistanceServiceTest extends TestCase
{
    private $locationDistanceSevice;
    private $geofence;

    public function setUp(): void
    {
        parent::setUp();
        $this->geofence = \Mockery::mock(GeoFenceCalculator::class);
        $this->locationDistanceSevice = new LocationDistanceService(new GeoFenceCalculator());
    }

    public function testShouldGetParameterMeasureSuccessfully()
    {
        $this->assertIsString($this->locationDistanceSevice->getMeasureParameter());
    }

    public function testShouldCalculateDistanceSuccessfully()
    {
        $firstLocation = ['latitude' => '38.199020', 'longitude' => '-77.969658'];
        $secondLocation = ['latitude' => '37.090240', 'longitude' => '-95.712891'];
        $this->geofence->shouldReceive('CalculateDistance')->andReturn(972);
        $this->assertEquals(972, $this->locationDistanceSevice->calculateDistance($firstLocation, $secondLocation));
    }
}
