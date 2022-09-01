<?php

namespace App\Modules\Destination\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Modules\Destination\Models\Destination;
use App\Modules\Carrange\Models\Carrange;
use App\Modules\Destination\Models\Destinationcarranges;

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
        $data->Depart=Destination::find($request->IdDepart);
        $data->destination=Destination::find($request->destination_id);
        $data->Carrange=Carrange::find($request->carrange_id);

        return [
            "payload" => $data,
            "status" => "200"
        ];
    }

    public function deleteDestinationcarrangesByid(Request $request){

            DB::table('destinationcarranges')
            ->where('id','=', $request->id)
            ->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];

    }
    public function UpdateDestinationcarrangesByid(Request $request){
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



            DB::table('destinationcarranges')
            ->where('id', $request->id)
            ->update([
                'carrange_id' => $request->carrange_id,
                'IdDepart' => $request->IdDepart,
                'destination_id' => $request->destination_id,
                'Price' => $request->Price
                            ]

            );

            $data = new stdClass();
            $data->id=$request->id;
            $data->Price=$request->Price;
            $data->Depart=Destination::find($request->IdDepart);
            $data->destination=Destination::find($request->destination_id);
            $data->Carrange=Carrange::find($request->carrange_id);

        return [
            "payload" => $data,
            "status" => "200_4"
        ];

}

    public function getdestination_carranges_by_destination_id(){
        $destinationcarranges=Destinationcarranges::all();
        $Data=[];

        for ($i=0; $i <count($destinationcarranges) ; $i++) {

            array_push($Data,[
                "id"=>$destinationcarranges[$i]->id,
                "Price" => $destinationcarranges[$i]->Price,
                 "reservation"=>$destinationcarranges[$i],
                 "Depart" => Destination::find($destinationcarranges[$i]->IdDepart),
                 "destination" => Destination::find($destinationcarranges[$i]->destination_id),
                 "Carrange" => Carrange::find($destinationcarranges[$i]->carrange_id),

             ]);
           }


            return [
                "payload" => $Data,
                "status" => "200_1"
            ];

    }


   
}
