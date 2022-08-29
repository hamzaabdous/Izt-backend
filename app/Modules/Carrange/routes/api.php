<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Carrange\Http\Controllers\CarrangeController;


Route::group([
    'prefix' => 'api/carrange'

], function ($router) {
    Route::get('/', [CarrangeController::class, 'index']);
    Route::get('/{id}', [CarrangeController::class, 'get']);
    Route::post('/create', [CarrangeController::class, 'create']);
    Route::post('/update', [CarrangeController::class, 'update']);
    Route::post('/delete', [CarrangeController::class, 'delete']);

});
