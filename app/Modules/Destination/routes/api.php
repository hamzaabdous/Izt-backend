<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Modules\Destination\Http\Controllers\DestinationController;
use App\Modules\Destination\Http\Controllers\DestinationcarrangesController;


Route::group([
    'prefix' => 'api/destination'

], function ($router) {
    Route::get('/', [DestinationController::class, 'index']);
    Route::get('/{id}', [DestinationController::class, 'get']);
    Route::post('/create', [DestinationController::class, 'create']);
    Route::post('/update', [DestinationController::class, 'update']);
    Route::post('/delete', [DestinationController::class, 'delete']);

});

Route::group([
    'prefix' => 'api/destinationcarranges'

], function ($router) {

    Route::post('/addDestinationcarranges', [DestinationcarrangesController::class, 'addDestinationcarranges']);
    Route::post('/deleteDestinationcarrangesBydestination_id', [DestinationcarrangesController::class, 'deleteDestinationcarrangesBydestination_id']);
    Route::get('/getdestination_carranges_by_destination_id', [DestinationcarrangesController::class, 'getdestination_carranges_by_destination_id']);

});
