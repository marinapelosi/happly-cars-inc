<?php

namespace App\Services\GeoLocation;

use Salman\GeoFence\Service\GeoFenceCalculator;

class LocationDistanceService
{
    private $geoCalculator;

    const SECONDS_OF_ONE_DAY = 86400;

    public function __construct(GeoFenceCalculator $geoCalculator)
    {
        $this->geoCalculator = $geoCalculator;
    }

    public function calculateDrivingTime(
        array $firstLocation,
        array $secondLocation
    ): array {
        $url = env('GOOGLE_MAPS_DRIVING_TIME_API_URL')."origins=".$firstLocation['latitude'].",".$firstLocation['longitude']."&destinations=".$secondLocation['latitude'].",".$secondLocation['longitude']."&mode=driving&language=en&key=".env('GOOGLE_MAPS_API_KEY');
        $apiResponse = $this->callApiToCalculateDrivingTime($url);
        $dueInSeconds = $apiResponse['rows'][0]['elements'][0]['duration']['value'] ?? 0;
        $dueInDays = $this->transformSecondsInDays($dueInSeconds);

        return [
            'miles' => $this->calculateDistance($firstLocation, $secondLocation),
            'parameter' => $this->getMeasureParameter(),
            'delivery_due' => $dueInDays,
            'delivery_due_message' => $this->getDeliveryDueDateMessage($dueInDays)
        ];
    }

    public function calculateDistance(
        array $firstLocation,
        array $secondLocation
    ): int {
        return $this->geoCalculator->CalculateDistance(
                $firstLocation['latitude'] ?? '',
                $firstLocation['longitude'] ?? '',
                $secondLocation['latitude'] ?? '',
                $secondLocation['longitude'] ?? ''
            );
    }

    public function getMeasureParameter(): string
    {
        return 'miles';
    }

    public function transformSecondsInDays(int $seconds): int
    {
        return $seconds / self::SECONDS_OF_ONE_DAY;
    }

    public function getDeliveryDueDateMessage(int $days): string
    {
        $message = 'Will be delivered in '.$days.' days';

        if ($days < 1) {
           $message = __('messages.delivery_due_date_today');
        }

        if ($days === 1) {
            $message = __('messages.delivery_due_date_today');
        }

        return $message;
    }

    public function callApiToCalculateDrivingTime(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
