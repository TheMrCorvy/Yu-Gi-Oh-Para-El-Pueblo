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
        'id_usuario',
    ];
}
