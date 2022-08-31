<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Modules\User\Models\User;

class UserController extends Controller
{

    public function index(){

        $users=User::all();

        return [
            "payload" => $users,
            "status" => "200_00"
        ];
    }

    public function get($id){
        $user=User::find($id);

        if(!$user){
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404_1"
            ];
        }
        else {
            return [
                "payload" => $user,
                "status" => "200_1"
            ];
        }
    }

    public function changePassword(Request $request){

        $validator = Validator::make($request->all(), [
            "id" => "required",
            "password" => "required|string",

        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $user=User::find($request->id);
        if (!$user) {
            return [
                "payload" => "The searched row does not exist !",
                "status" => "404"
            ];
        }


        $user->password=$request->password;

        $user->save();
        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            "username" => "required|string|unique:users,username",
            "role" => "required",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406_2"
            ];
        }

        $user=User::make($request->all());
        $user->password="admin123";
        $user->save();

        return [
            "payload" => $user,
            "status" => "200"
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return [
                "payload" => $validator->errors(),
                "status" => "406"
            ];
        }
        $user = User::where('username', $request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return [
                "payload" => "Incorrect username or password !",
                "status" => "401"
            ];
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return [
            "payload" => $response,
            "status" => "200"
        ];
    }
}
