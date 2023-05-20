<?php

namespace App\Services\GeoLocation;

use Salman\GeoFence\Service\GeoFenceCalculator;

class LocationDistanceService
{
    private $geoCalculator;

    public function __construct(GeoFenceCalculator $geoCalculator)
    {
        $this->geoCalculator = $geoCalculator;
    }

    public function getMeasureParameter(): string
    {
        return 'miles';
    }

    public function calculateDistance(
        array $firstLocation,
        array $secondLocation
    ): float {
        return number_format(
            $this->geoCalculator->CalculateDistance(
                $firstLocation['latitude'] ?? '',
                $firstLocation['longitude'] ?? '',
                $secondLocation['latitude'] ?? '',
                $secondLocation['longitude'] ?? ''
            ),
            2
        );
    }
}
