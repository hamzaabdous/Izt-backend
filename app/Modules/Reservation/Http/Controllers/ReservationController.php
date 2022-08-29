<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Modules\Reservation\Models\Reservation;

class ReservationController extends Controller
{

    public function index()
    {
        $reservation = Reservation::with('destination_carranges')->get();
       // $reservation->destination_id=$reservation->destination_carranges->destination_id;

       return [
            "payload" => $reservation,
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
            $reservation->destination_id=$reservation->destination_carranges->destination_id;

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
        return [
            "payload" => $reservation,
            "status" => "200"
        ];
    }
}
