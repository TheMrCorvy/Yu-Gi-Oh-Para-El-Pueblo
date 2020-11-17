<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "cartas_pedidas";

    protected $fillable = [
        'nombre_carta',
        'expansion',
        'comentario',
        'cantidad',
        'precio',
        'id_usuario'
    ];
}
