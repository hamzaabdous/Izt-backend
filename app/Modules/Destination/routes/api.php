<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Destination\Http\Controllers\DestinationController;


Route::group([
    'prefix' => 'api/destination'

], function ($router) {
    Route::get('/', [DestinationController::class, 'index']);
    Route::get('/{id}', [DestinationController::class, 'get']);
    Route::post('/create', [DestinationController::class, 'create']);
    Route::post('/update', [DestinationController::class, 'update']);
    Route::post('/delete', [DestinationController::class, 'delete']);

});
