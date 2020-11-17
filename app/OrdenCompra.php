<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    protected $table = 'ordenes_compras';

    protected $fillable = [
        'fecha',
        'username',
        'forma_de_pago',
        'monto_total',
        'nombre', 
        'dni', 
        'calle',
        'altura',
        'provincia',
        'ciudad', 
        'envio',
        'codigo_postal',
        'finalizada'
    ];
}
