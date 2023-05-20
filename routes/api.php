<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarLocationController;
use App\Http\Resources\StateCollection;
use App\Models\State;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Http\Resources\DeliveryCollection;
use App\Models\Delivery;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeliveryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('/tokens/create', function (Request $request) {
//    $token = $request->user()->createToken($request->token_name);
//
//    return ['token' => $token->plainTextToken];
//});


// @TODO: make non public
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
