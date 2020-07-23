<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";

    protected $fillable = [
        // 'username',
        'id_producto',
        'producto',
        // 'fecha',
        'precio_unidad',
        'unidades_compradas',
        // 'forma_de_pago',
        // 'mes',
        // 'monto_total'
        'orden_compra'
    ];
}
