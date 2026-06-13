<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['titulo', 'data', 'hora', 'descricao'])]
class Evento extends Model
{
    protected $table = 'eventos';
}
