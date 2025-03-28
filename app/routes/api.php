<?php

use App\Http\Controllers\api\v1\Auth\AuthController;
use App\Http\Controllers\api\v1\Bookings\BookingController;
use App\Http\Controllers\api\v1\Bookings\BookingListController;
use App\Http\Controllers\api\v1\Resources\ResourceController;
use App\Http\Controllers\api\v1\Resources\ResourceTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('resourcetypes', ResourceTypeController::class)->except('edit', 'destroy', 'create');

    Route::get('resources/{id}/bookings', [BookingListController::class, 'list']);
    Route::apiResource('resources', ResourceController::class)->only('index', 'store');

    Route::apiResource('bookings', BookingController::class)->only('store', 'destroy',);
});

