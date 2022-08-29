<?php

namespace App\Modules\Carrange\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarrangeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Carrange::welcome");
    }
}
