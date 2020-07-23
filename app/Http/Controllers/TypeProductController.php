<?php

namespace App\Http\Controllers;

use App\TypeProduct;
use Illuminate\Http\Request;

class TypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TypeProduct::select('tipo_producto', 'id')->get();

        return response()->json(compact('tipos'));
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
            'unique' => 'Ya existe un tipo de producto con ese nombre.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $tipoProducto = request()->validate([
            'tipoProductoCrear' => 'required|string|min:2|max:35|unique:App\TypeProduct,tipo_producto',
        ], $messages);

        TypeProduct::create([
            'tipo_producto' => $tipoProducto['tipoProductoCrear'],
        ]);

        return back()->withMessage('Tipo de producto creado exitósamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = TypeProduct::find($id);

        return response()->json(compact('tipo'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeProduct  $typeProduct
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

        $tipoProducto = request()->validate([
            'tipoProductoEditar' => 'required|string|min:2|max:35|unique:App\TypeProduct,tipo_producto',
        ], $messages);

        $typeProduct = TypeProduct::find($id);
        
        $typeProduct->tipo_producto = $tipoProducto['tipoProductoEditar'];

        $typeProduct->save();

        return back()->withMessage('Tipo de producto editado exitósamente.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeProduct $typeProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeProduct  $typeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeProduct $typeProduct)
    {
        //
    }
}
