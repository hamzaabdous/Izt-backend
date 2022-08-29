<?php

namespace App\Modules\Carrange\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Destination\Models\Destination;
use App\Modules\Car\Models\Car;

class Carrange extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function car()
    {
        return $this->hasMany(Car::class,'IdCarRange');
    }


    public function destinationIdDepart()
    {
        return $this->belongsToMany(Destination::class,"IdDepart")->withTimestamps();

    }
    public function destinationIdDestination()
    {
        return $this->belongsToMany(Destination::class,"IdDestination")->withTimestamps();

    }


    protected $fillable = [
        'Label',
        'MinPassengers',
        'MaxPassengers',
        'PricePercentage',
        
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
