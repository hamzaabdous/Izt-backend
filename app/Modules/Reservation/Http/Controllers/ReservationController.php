<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Reservation\Models\Reservation;
use App\Modules\Destination\Models\Destination;
use App\Modules\Carrange\Models\Carrange;

class ReservationController extends Controller
{

    public function index()
    {
        $reservation = Reservation::with('destination_carranges')->get();
       // $reservation->destination_id=$reservation->destination_carranges->destination_id;
       $Data=[];
       for ($i=0; $i <count($reservation) ; $i++) {

        array_push($Data,[
             "reservation"=>$reservation[$i],
             "destination_carranges" => $reservation[$i]->destination_carranges,
             "Depart" => Destination::find($reservation[$i]->destination_carranges->IdDepart),
             "Destination_" => Destination::find($reservation[$i]->destination_carranges->destination_id),
             "Carrange" => Carrange::find($reservation[$i]->destination_carranges->carrange_id),

         ]);
       }
        return [
            "payload" => $Data,
            "status" => "200_00"
        ];
    }

    public function SearchOffre(Request $request)
    {

        $reservation = Reservation::with('destination_carranges')->get();
       // $reservation->destination_id=$reservation->destination_carranges->destination_id;
       $Data=[];
       for ($i=0; $i <count($reservation) ; $i++) {

        if ($reservation[$i]->NbrPersons==$request->NbrPersons && $reservation[$i]->destination_carranges->IdDepart==$request->IdDepart && $reservation[$i]->destination_carranges->destination_id==$request->destination_id) {

            $carrange=Carrange::find($reservation[$i]->destination_carranges->carrange_id);
            $car=$carrange->car[0];
            array_push($Data,[
                "IdDestinationCarRange"=>$reservation[$i]->IdDestinationCarRange,
                "Prix" => $reservation[$i]->destination_carranges->Price + $reservation[$i]->destination_carranges->Price*($carrange->PricePercentage/100),
                "Label" => $car->Label,
                "CarImage" => $car->CarImage,

            ]);
        }
       }
        return [
            "payload" => $Data,
            "status" => "200_00"
        ];
    }

    public function get($id)
    {
        $reservation=Reservation::find($id);
        if(!$reservation){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            $reservation->destination_carranges=$reservation->destination_carranges;
            $reservation->Depart=Destination::find($reservation->destination_carranges->IdDepart);
            $reservation->Destination=Destination::find($reservation->destination_carranges->destination_id);
            $reservation->carrange=Carrange::find($reservation->destination_carranges->carrange_id);

            return [
                "payload" => $reservation,
                "status" => "200_1"
            ];
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "NbrPersons" => "required|integer:reservations,NbrPersons",
            "NbrLuggage" => "required|integer:reservations,NbrLuggage",
            "FirstName" => "required|string:reservations,FirstName",
            "LastName" => "required|string:reservations,LastName",
            "Email" => "required|string:reservations,Email",
            "PhoneNumber" => "required|string:reservations,PhoneNumber",
            "IdDestinationCarRange" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }
        $reservation=Reservation::make($request->all());
        $reservation->save();
        $Data=[];
        array_push($Data,[
            "reservation"=>$reservation,
            "destination_carranges" => $reservation->destination_carranges,
            "Depart" => Destination::find($reservation->destination_carranges->IdDepart),
            "Destination_" => Destination::find($reservation->destination_carranges->destination_id),
            "Carrange" => Carrange::find($reservation->destination_carranges->carrange_id),

        ]);
        return [
            "payload" => $Data[0],
            "status" => "200"
        ];
    }

    public function delete(Request $request){
        $reservation=Reservation::find($request->id);
        if(!$reservation){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_4"
            ];
        }
        else {
            $reservation->delete();
            return [
                "payload" => "Deleted successfully",
                "status" => "200_4"
            ];
        }
    }

}
