<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCarta extends Model
{
    protected $fillable = [
        'tipo_carta',
    ];

    protected $table = 'type_cartas';
}
