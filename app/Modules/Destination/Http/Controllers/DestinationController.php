<?php

namespace App\Modules\Destination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Destination\Models\Destination;
class DestinationController extends Controller
{

    public function index()
    {
        $destination = Destination::all();
        return [
            "payload" => $destination,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $destination=Destination::find($id);
        if(!$destination){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $destination,
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
        $destination=Destination::make($request->all());
        $destination->save();
        return [
            "payload" => $destination,
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
        $destination=Destination::find($request->id);
        if (!$destination) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_3"
            ];
        }

        $destination->Label=$request->Label;

        $destination->save();
        return [
            "payload" => $destination,
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $destination=Destination::find($request->id);
        if(!$destination){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $destination->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }
}
