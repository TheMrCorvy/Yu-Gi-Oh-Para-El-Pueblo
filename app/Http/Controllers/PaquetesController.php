<?php

namespace App\Http\Controllers;

use Cart;
use Auth;
use App\Paquete;
use Illuminate\Http\Request;
use App\Mail\MailPedidoImportacion;
use Illuminate\Support\Facades\Mail;

class PaquetesController extends Controller
{
    public function PedirPresupuesto()
    {
        $request = request()->validate([
            'id-paquete' => 'required|integer|exists:paquetes,id',
        ]);

        $paquete = Paquete::find($request['id-paquete']);

        if ($paquete->username !== Auth::user()->username) 
        {
            return view('errors.404');
        }

        if ($paquete->estado !== "Abierto" || $paquete->estado !== "Abierto y Confirmado") 
        {
            $paquete->estado = "Revisando";

            $paquete->fecha_caducidad_precio = null;

            $paquete->save();

            Mail::to('mr.corvy@gmail.com')->send(new MailPedidoImportacion($paquete->id));

            return redirect()->to(route('Importar Cartas'));

        }else 
        {
            return view('errors.404');
        }
    }
    
    public function realizarPagoFinal($idPaquete)
    {
        $paquete = Paquete::find($idPaquete);

        if (Auth::user()->username !== $paquete->username || $paquete->estado !== 'El paquete llegó al local') 
        {
            return view('errors.404');
        }

        $pedidos = Pedido::where('paquete', $idPaquete)->get();

        Cart::session(auth()->id())->clear();

        $montoTotal = 0;

        foreach ($pedidos as $pedido) 
        {
            $montoTotal = $montoTotal + ($pedido->precio * $pedido->cantidad);
        }

        $pagoInicial = $montoTotal / 10;

        session()->put('pagando_seña', $idPaquete);

        session()->put('pago_inicial', ceil($montoTotal - $pagoInicial));

        Cart::session(auth()->id())->add(array(
            'id' => $idPaquete,
            'name' => 'Pago Final Pedido de Importación',
            'price' => ceil($montoTotal - $pagoInicial),
            'quantity' => 1,
            'attributes' => array('https://prueba-servicio-al-toque.s3-sa-east-1.amazonaws.com/seo_img/logo.jpeg', 1),
            'associatedModel' => $paquete,
        ));

        return redirect()
                        ->route('Checkout')
                        ->with([
                            'formulario' => '3', 
                            'ordenCompra' => $paquete->orden_compra, 
                            'usuario' => User::find(Auth::user()->id),
                        ]);
    }
}
