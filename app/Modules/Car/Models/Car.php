<?php

namespace App\Modules\Car\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Carrange\Models\Carrange;

class Car extends Model
{
    use HasFactory;
    protected $guarded=["id"];


    public function carrange()
    {
        return $this->belongsTo(Carrange::class,"IdCarRange");
    }


    protected $fillable = [
        'IdCarRange',
        'Label',
        'CarImage',
    ];


    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
