<?php

namespace App\Modules\Reservation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Modules\Destination\Models\Destinationcarranges;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded=["id"];


    public function destination_carranges()
    {
        return $this->belongsTo(Destinationcarranges::class,"IdDestinationCarRange","id");
    }

    protected $fillable = [
        'NbrPersons',
        'NbrLuggage',
        'FirstName',
        'LastName',
        'Email',
        'PhoneNumber',
        'IdDestinationCarRange',

    ];


    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
