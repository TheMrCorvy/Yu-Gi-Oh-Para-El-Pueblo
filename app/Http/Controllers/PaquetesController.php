<?php

namespace App\Http\Controllers;

use Auth;
use App\Paquete;
use Illuminate\Http\Request;
use App\Mail\MailPedidoImportacion;
use Illuminate\Support\Facades\Mail;

class PaquetesController extends Controller
{
    public function NotificarPedidoDeCartas()
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

            $paquete->save();

            Mail::to('mr.corvy@gmail.com')->send(new MailPedidoImportacion($paquete->id));

            return redirect()->to(route('Importar Cartas'));

        }else 
        {
            return view('errors.404');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show(Paquete $paquete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paquete $paquete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paquete $paquete)
    {
        //
    }
}
