<?php

namespace App\Modules\Car\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Car\Models\Car;

class CarController extends Controller
{


    public function index()
    {
        $cars = Car::with('carrange')->get();
        return [
            "payload" => $cars,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $car=Car::find($id);
        if(!$car){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $car->carrange=$car->carrange;
            return [
                "payload" => $car,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "Label" => "required|string|unique:cars,Label",
            "CarImage" => "string:cars,CarImage",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $car=Car::make($request->all());
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('images',$filename,'public');
      //  $car()->update(['CarImage'=>$filename]);
        $car->CarImage="/storage/images/".$filename;

        $car->save();
        $car->carrange=$car->carrange;
        return [
            "payload" => $car,
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
        $car=Car::find($request->id);
        if (!$car) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $car->Label=$request->Label;
        $car->IdCarRange=$request->IdCarRange;
        $car->CarImage=$request->CarImage;
        $car->save();
        $car->carrange=$car->carrange;
        return [
            "payload" => $car,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $car=Car::find($request->id);
        if(!$car){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $car->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
