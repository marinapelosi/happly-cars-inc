<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\User;
use App\Services\DeliveryService;
use App\Services\GeoLocation\LocationDistanceService;
use App\Services\StateService;
use Illuminate\Http\JsonResponse;
use Salman\GeoFence\Facades\GeoFence;
use Salman\GeoFence\Service\GeoFenceCalculator;

class DeliveryController extends Controller
{
    public function get()
    {
        return response()->json([
            'deliveries' => DeliveryService::getDelivery()
        ], 200);
    }

    public function store(StoreDeliveryRequest $request): JsonResponse
    {
        try {
            $delivery = $request->all();
            $delivery['user_id'] = User::inRandomOrder()->first()->id; // @TODO: colocar o usuário logado aqui
            $delivery['delivery_location'] = json_encode(StateService::getStateByCode($request->input('delivery_location_code')));
            $delivery['delivered'] = DeliveryService::setDeliveryFinishedBecauseWeArePretendingAllTheProcessIsDone();
            $delivery['delivery_finish_date'] = DeliveryService::calculateDaysOfDelivery(
                $request->input('delivery_start_date'),
                $request->input('delivery_deadline_in_days')
            );

            $deliveryRequested = Delivery::create($delivery);

            //@TODO - setar carro selecionado omo indisponível na location

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
