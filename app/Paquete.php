<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = "paquetes";

    protected $fillable = [
        'estado',
        'fecha_caducidad_precio',
        'pago_inicial',
        'comentario_al_paquete',
        'username',
        'envio',
        'orden_compra',
    ];

    protected $dates = ['created_at', 'fecha_caducidad_precio'];
}
