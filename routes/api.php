<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\BikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/customers'], function (){
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::put('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'destroy']);
});

Route::group(['prefix' => 'v1/items'], function (){
    Route::get('/', [ItemController::class, 'index']);
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::post('/', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

Route::group(['prefix' => 'v1/orders'], function (){
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

Route::group(['prefix' => 'v1/deliveries'], function (){
    Route::get('/', [DeliveryController::class, 'index']);
    Route::get('/{id}', [DeliveryController::class, 'show']);
    Route::post('/', [DeliveryController::class, 'store']);
    Route::put('/{id}', [DeliveryController::class, 'update']);
    Route::delete('/{id}', [DeliveryController::class, 'destroy']);
});

Route::group(['prefix' => 'v1/bikes'], function (){
    Route::get('/', [BikeController::class, 'index']);
    Route::get('/{id}', [BikeController::class, 'show']);
    Route::post('/', [BikeController::class, 'store']);
    Route::put('/{id}', [BikeController::class, 'update']);
    Route::delete('/{id}', [BikeController::class, 'destroy']);
});