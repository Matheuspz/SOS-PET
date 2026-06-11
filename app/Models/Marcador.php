<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['titulo', 'latitude', 'longitude', 'tipo'])]
class Marcador extends Model
{
    //
}
