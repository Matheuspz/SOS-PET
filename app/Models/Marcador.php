<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('titulo','descricao','latitude','longitude')]
class Marcador extends Model
{
    protected $guarded = [];
    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'properties' => 'array',
    ];
    public function getLatLngAttribute()
    {
        return [
            'lat' => $this->latitude,
            'lng' => $this->longitude,
        ];
    }

    protected $table = "marcadores";

}
