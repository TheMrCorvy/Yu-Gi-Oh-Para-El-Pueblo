<?php

namespace App\Http\Controllers;

use App\TypeCarta;
use Illuminate\Http\Request;

class TypeCartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposCartas = TypeCarta::select('tipo_carta', 'id')->get();

        return response()->json(compact('tiposCartas'));
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
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'unique' => 'Ya existe un producto con ese nombre.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $tipoCarta = request()->validate([
            'tipoCartaCrear' => 'required|string|min:2|max:35|unique:App\TypeProduct,tipo_producto',
        ], $messages);

        TypeCarta::create([
            'tipo_carta' => $tipoCarta['tipoCartaCrear'],
        ]);

        return back()->withMessage('Tipo de carta creado exitósamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeCarta  $typeCarta
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCarta $typeCarta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeCarta  $typeCarta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'unique' => 'Ya existe un tipo de producto con ese nombre.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $tipoCarta = request()->validate([
            'tipoCartaEditar' => 'required|string|min:2|max:35|unique:App\TypeCarta,tipo_carta',
        ], $messages);

        $typeCarta = TypeCarta::find($id);
        
        $typeCarta->tipo_carta = $tipoCarta['tipoCartaEditar'];

        $typeCarta->save();

        return back()->withMessage('Tipo de Carta editado exitósamente.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeCarta  $typeCarta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeCarta $typeCarta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeCarta  $typeCarta
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCarta $typeCarta)
    {
        //
    }
}
