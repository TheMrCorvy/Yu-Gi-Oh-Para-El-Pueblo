<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Multiplicador;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Category::select('categoria', 'id')->get();

        return response()->json(compact('categorias'));
    }

    public function BuscarCategories($parametro)
    {
        $pedido = trim($parametro);

        $resultado = Category::where('categoria', 'LIKE', '%' . $pedido . '%' )
                                ->orderBy('categoria', 'ASC')
                                ->first();

        return response()->json(compact('resultado'));
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

        $categoria = request()->validate([
            'nombreCategoryCrear' => 'required|string|min:2|max:35|unique:App\Category,categoria',
            'rutaCategoryCrear' => 'required|string|min:2|max:15|unique:App\Category,ruta',
        ], $messages);

        Category::create([
            'categoria' => $categoria['nombreCategoryCrear'],
            'ruta' => $categoria['rutaCategoryCrear'],
        ]);

        return back()->withMessage('Categoría creada exitósamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function ShowOtros()
    {
        $categoria = Category::select('id', 'ruta', 'categoria')->where('id', '1')->first();

        $resultados = Product::select('id', 'link_img', 'nombre', 'precio')
                                            ->orderBy('producto', 'DESC')
                                            ->where('categoria', 1)//productos general
                                            ->where('stock', '>=', 1)
                                            ->paginate(20);

        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        return view('categorias', compact('categoria', 'resultados', 'multiplicador'));
    }
    public function ShowGeneral($category)
    {
        $categoria = Category::select('id', 'ruta', 'categoria')->where('ruta', $category)->first();

        $resultados = Product::select('id', 'link_img', 'nombre', 'precio')
                                            ->orderBy('producto', 'DESC')
                                            ->where('categoria', $categoria->id)
                                            ->where('stock', '>=', 1)
                                            ->paginate(20);
                                            
        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        return view('categorias', compact('categoria', 'resultados', 'multiplicador'));
    }

    public function ShowCategoriaFiltro($category, $params)
    {
        $categoria = Category::select('id', 'ruta', 'categoria')->where('ruta', $category)->first();

        switch ($params) {
            case 'a-z':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('nombre', 'ASC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'z-a':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('nombre', 'DESC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'precio-mayor-menor':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('precio', 'DESC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'precio-menor-mayor':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('precio', 'ASC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'recientes':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('id', 'DESC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'no-tan-recientes':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('id', 'ASC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            
            default:
            $resultados = Product::select('precio', 'nombre', 'link_img', 'id', 'oferta')
                                    ->orderBy('id', 'DESC')
                                    ->where('categoria', $categoria->id)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
        }

        $multiplicador = Multiplicador::select('multiplicador')->first();

        return view('categorias', compact('resultados', 'multiplicador', 'categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $categoria = request()->validate([
            'nombreCategoryEditar' => 'required|string|min:2|max:35',
            'rutaCategoryEditar' => 'required|string|min:2|max:15',
        ], $messages);

        $Category = Category::find($id);
        
        $Category->categoria = $categoria['nombreCategoryEditar'];

        $Category->ruta = $categoria['rutaCategoryEditar'];

        $Category->save();

        return back()->withMessage('Categoría editada exitósamente.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
