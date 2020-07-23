<?php

namespace App\Http\Controllers;

use App\Multiplicador;
use Illuminate\Http\Request;

class MultiplicadorController extends Controller
{
    public function ActualizarDolar (Request $request)
    {
        $dolar = Multiplicador::all();
        
        $dolar[0]->multiplicador = $request['dolarActual'];

        $dolar[0]->save();

        return redirect('/admin');
    }
}
