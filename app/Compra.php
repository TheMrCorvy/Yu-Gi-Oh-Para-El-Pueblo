<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";

    protected $fillable = [
        'id_producto',
        'producto',
        'precio_unidad',
        'unidades_compradas',
        'orden_compra',
    ];
}
