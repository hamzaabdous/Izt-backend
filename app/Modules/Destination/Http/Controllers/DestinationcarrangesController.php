<?php

namespace App\Modules\Destination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Modules\Destination\Models\Destination;
use App\Modules\Carrange\Models\Carrange;
use \stdClass;

class DestinationcarrangesController extends Controller
{
    public function addDestinationcarranges(Request $request){
         $validator = Validator::make($request->all(), [
            "carrange_id" => "required",
            "IdDepart" => "required",
            "carrange_id" => "required",

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $carrange=Carrange::find($request->carrange_id);
        if(!$carrange){
            return [
                "payload"=>"carrange is not exist !",
                "status"=>"carrange_404",
            ];
        }
         $destinationDepart=Destination::find($request->IdDepart);
        if(!$destinationDepart){
            return [
                "payload"=>"Depart is not exist !",
                "status"=>"Depart_404",
            ];
        }
        /*  $destinationDestination=Destination::find($request->IdDestination);
        if(!$destinationDestination){
            return [
                "payload"=>"Destination is not exist !",
                "status"=>"Destination_404",
            ];
        } */


        $destinationDepart->carrange()->attach('carrange_id', [
            //you can pass any other pivot filed value you want in here
            'IdDepart' => $request->IdDepart,
            'destination_id' => $request->destination_id,
            'carrange_id' => $request->carrange_id,
            'Price' => $request->Price,

        ]);
        $data = new stdClass();
        $data->id=DB::getPdo()->lastInsertId();
        $data->Price=$request->Price;
        $data->destination_Depart=Destination::find($request->IdDepart);
        $data->destination_Destination=Destination::find($request->destination_id);
        $data->carrange=Carrange::find($request->carrange_id);

        return [
            "payload" => $data,
            "status" => "200"
        ];
    }

}
