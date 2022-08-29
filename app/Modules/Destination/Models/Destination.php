<?php

namespace App\Modules\Destination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Carrange\Models\Carrange;

class Destination extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function carrange()
    {
        return $this->belongsToMany(Carrange::class,"IdCarRange")->withTimestamps();

    }

    protected $fillable = [
        'Label',
        'IdCarRange'
    ];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',

    ];
}
