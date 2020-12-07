<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoEnvio extends Model
{
    protected $table = "metodos_de_envio";

    protected $fillable = [
        'metodo',
        'tiempo_previsto',
    ];
}
