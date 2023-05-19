<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CarResource;
use App\Http\Resources\CarCollection;
use App\Http\Requests\StoreCarRequest;
use App\Models\Car;
use App\Models\CarLocation;
use App\Http\Controllers\CarLocationController;
use App\Http\Resources\StateCollection;
use App\Models\State;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Http\Resources\DeliveryCollection;
use App\Models\Delivery;

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
//
//Route::get('/cars-types', function () {
//    return new CarCollection(Car::with(['type'])->get());
//});
//
//Route::get('/cars', function () {
//    return new CarCollection(Car::with(['type'])->get());
//});
//
//Route::get('/cars-locations', [CarLocationController::class, 'list']);

//Route::post('/cars', function (Request $request) {
//    return new CarResource(Car::create(new StoreCarRequest($request->all())));
//});

// @TODO: make non public
# State / Location
Route::get('/states', function () {
    return new StateCollection(State::get());
})->name('states');

# Cars
Route::get('/available-cars', [CarLocationController::class, 'getAvailableCars'])->name('available-cars');
Route::get('/unavailable-cars', [CarLocationController::class, 'getUnavailableCars'])->name('unavailable-cars');
Route::get('/cars-with-location', [CarLocationController::class, 'getCarsWithLocation'])->name('cars-with-location');

# Users
Route::get('/costumers', function () {
    return new UserCollection(User::costumer()->get());
})->name('costumers');

# Delivery
Route::get('/deliveries-requested', function () {
    return new DeliveryCollection(Delivery::requested()->with(['car', 'location'])->get());
})->name('deliveries-requested');

Route::get('/deliveries-finished', function () {
    return new DeliveryCollection(Delivery::completed()->with(['car', 'location'])->get());
})->name('deliveries-finished');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
