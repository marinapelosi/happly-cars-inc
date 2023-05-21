<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarLocationController;
use App\Http\Resources\StateCollection;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryController;
use App\Models\State;

# User Login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    # States / Locations
    Route::get('/states', function () {
        return new StateCollection(State::get());
    })->name('states');

    # Cars
    Route::get('/available-cars', [CarLocationController::class, 'getAvailableCars'])->name('available-cars');
    Route::get('/unavailable-cars', [CarLocationController::class, 'getUnavailableCars'])->name('unavailable-cars');
    Route::get('/cars', [\App\Http\Controllers\CarController::class, 'get'])->name('cars');

    # Users
    Route::get('/costumers', [UserController::class, 'get'])->name('costumers');
    Route::get('/costumers/{id}', [UserController::class, 'get'])->name('costumers');
    Route::post('/costumers', [UserController::class, 'store'])->name('costumers');

    # Delivery
    Route::get('/deliveries', [DeliveryController::class, 'get'])->name('deliveries');
    Route::get('/deliveries/{id}', [DeliveryController::class, 'get'])->name('deliveries');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('deliveries');
    Route::post('/delivery-schedule', [DeliveryController::class, 'getDeliverySchedule'])->name('delivery-schedule');

    # User Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
