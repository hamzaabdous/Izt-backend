<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Car\Http\Controllers\CarController;


Route::group([
    'prefix' => 'api/car'

], function ($router) {
    Route::get('/', [CarController::class, 'index']);
    Route::get('/{id}', [CarController::class, 'get']);
    Route::post('/create', [CarController::class, 'create']);
    Route::post('/update', [CarController::class, 'update']);
    Route::post('/delete', [CarController::class, 'delete']);

});
