<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuponUser extends Model
{
    protected $table = "cupones_usuarios";

    protected $fillable = [
        'codigo',
        'username',
    ];
}
