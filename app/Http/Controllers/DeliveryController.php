<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Services\CarService;
use App\Services\DeliveryService;
use App\Services\ScheduleService;
use App\Services\StateService;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    public function get()
    {
        return response()->json([
            'deliveries' => DeliveryService::getDelivery()
        ], 200);
    }

    public function getDeliverySchedule(StoreDeliveryRequest $request): JsonResponse
    {
        $request = $request->all();
        $schedule = ScheduleService::generateSchedule($request);

        return response()->json([
            'status' => 201,
            'message' => $schedule['estimated_due']['delivery_due_message'],
            'schedule' => $schedule,
            'payload_to_request' => DeliveryService::generateDeliveryRequestPayload($request, $schedule)
        ], 201);
    }

    public function store(StoreDeliveryRequest $request): JsonResponse
    {
        try {
            $delivery = $request->all();
            $delivery['user_id'] = auth()->user()->id;
            $delivery['delivery_location'] = json_encode(StateService::getStateByCode($request->input('delivery_location_code')));
            $delivery['delivered'] = DeliveryService::setDeliveryFinishedBecauseWeArePretendingAllTheProcessIsDone();
            $delivery['delivery_finish_date'] = DeliveryService::calculateDaysOfDelivery(
                $request->input('delivery_start_date'),
                $request->input('delivery_deadline_in_days')
            );

            $deliveryRequested = Delivery::create($delivery);

            CarService::setCarUnavailable($delivery['car_located_id']);

            return response()->json([
                'status' => 201,
                'message' => __('messages.delivery_finished'),
                'delivery' => DeliveryService::getDelivery($deliveryRequested->id)
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
