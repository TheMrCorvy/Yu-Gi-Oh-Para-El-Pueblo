<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $fillable = [
        'tipo_producto',
    ];

    protected $table = 'type_products';
}
