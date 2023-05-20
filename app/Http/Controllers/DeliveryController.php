<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\User;
use App\Services\DeliveryService;

class DeliveryController extends Controller
{
    public function store(StoreDeliveryRequest $request)
    {
        try {
            $delivery = $request->all();
            $delivery['user_id'] = User::first()->id; // @TODO: colocar o usuário logado aqui
            $delivery['delivered'] = DeliveryService::setDeliveryFinishedBecauseWeArePretendingAllTheProcessIsDone();
            $delivery['delivery_finish_date'] = DeliveryService::calculateDaysOfDelivery(
                $request->input('delivery_start_date'),
                $request->input('delivery_deadline_in_days')
            );
            $deliveryRequested = Delivery::create($delivery);

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
