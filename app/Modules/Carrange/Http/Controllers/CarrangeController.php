<?php

namespace App\Modules\Carrange\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Carrange\Models\Carrange;

class CarrangeController extends Controller
{

    public function index()
    {
        $carrange = Carrange::with('car')->get();
        return [
            "payload" => $carrange,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $carrange=Carrange::find($id);
        if(!$carrange){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $carrange->car=$carrange->car;
            return [
                "payload" => $carrange,
                "status" => "200_1"
            ];
        }
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "Label" => "required|string|unique:carranges,Label",
            "MinPassengers" => "required|integer:carranges,MinPassengers",
            "MaxPassengers" => "required|integer:carranges,MaxPassengers",
            "PricePercentage" => "required|integer:carranges,PricePercentage",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $carrange=Carrange::make($request->all());
        $carrange->save();
        $carrange->PricePercentage=$request->PricePercentage/100;

        $carrange->car=$carrange->car;
        return [
            "payload" => $carrange,
            "status" => "200"
        ];
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $carrange=Carrange::find($request->id);
        if (!$carrange) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $carrange->Label=$request->Label;
        $carrange->MinPassengers=$request->MinPassengers;
        $carrange->MaxPassengers=$request->MaxPassengers;
        $carrange->PricePercentage=$request->PricePercentage;

        $carrange->save();
        return [
            "payload" => $carrange,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $carrange=Carrange::find($request->id);
        if(!$carrange){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $carrange->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
