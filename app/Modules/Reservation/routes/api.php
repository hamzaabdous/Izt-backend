<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Reservation\Http\Controllers\ReservationController;


Route::group([
    'prefix' => 'api/reservation'

], function ($router) {
    Route::get('/', [ReservationController::class, 'index']);
    Route::get('/{id}', [ReservationController::class, 'get']);
    Route::post('/create', [ReservationController::class, 'create']);
    Route::post('/update', [ReservationController::class, 'update']);
    Route::post('/delete', [ReservationController::class, 'delete']);
    Route::post('/SearchOffre', [ReservationController::class, 'SearchOffre']);

});
