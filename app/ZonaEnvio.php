<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaEnvio extends Model
{
    protected $table = "zonas_de_envio";

    protected $fillable = [
        'zona',
        'precio',
        'metodo_envio',
    ];
}
