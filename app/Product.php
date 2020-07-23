<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// use App\TypeCarta;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'nombre',
        'producto',
        'precio',
        'stock',
        'link_img',
        'categoria',
        'estado',
        'cantidad_incluida',
        'expansion',
        'color',
        'idioma',
        'carta_id',
        'rareza',
        'oferta',
        'fecha_oferta',
        'marca',
        'size',
        'capacidad',
        'descripcion',
        'ubicacion_archivo_imagen',
    ];
}
