<?php

namespace App\Modules\Destination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Reservation\Models\Reservation;

class Destinationcarranges extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function Reservation()
    {
        return $this->hasMany(Reservation::class,"id");
    }

}
