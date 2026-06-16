<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('titulo','descricao','latitude','longitude', 'tipo', 'properties')]
class Marcador extends Model
{
    protected $table = 'marcadores';

    protected $fillable = [
        'titulo',
        'descricao',
        'latitude',
        'longitude',
        'tipo',
        'properties',
    ];

    protected $casts = [
        'latitude'   => 'decimal:8',
        'longitude'  => 'decimal:8',
        'properties' => 'array',
    ];
}
