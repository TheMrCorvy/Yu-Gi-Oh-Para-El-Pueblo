<?php

namespace App\Http\Controllers;

use App\Product;
use App\Multiplicador;
use Illuminate\Http\Request;

// use Validator;

use Illuminate\Support\Facades\Storage;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function ShowCartas($params = null)
    {
        switch ($params) {
            case 'a-z':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('nombre', 'ASC')
                                    ->where('producto', 1)//carta de yugioh
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)//categoria yugioh
                                    ->paginate(20);
                break;
            case 'z-a':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('nombre', 'DESC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'precio-mayor-menor':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('precio', 'DESC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'precio-menor-mayor':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('precio', 'ASC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'nuevos':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('id', 'DESC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'no-tan-nuevos':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('id', 'ASC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'rareza':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'rareza', 'id')
                                    ->orderBy('rareza', 'ASC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            case 'tipo':
                $resultados = Product::join('type_cartas', 'type_cartas.id', '=', 'products.carta_id')
                                    ->select('products.precio', 'products.nombre', 'products.link_img', 'type_cartas.tipo_carta as tipo_carta', 'products.id')
                                    ->orderBy('tipo_carta', 'ASC')
                                    ->where('products.producto', '=', 1)
                                    ->where('products.stock', '>=', 1)
                                    ->paginate(20);
                // https://w3path.com/laravel-6-joins-example-tutorial/
                break;
            case 'expansion':
                $resultados = Product::select('precio', 'nombre', 'link_img', 'expansion', 'id')
                                    ->orderBy('expansion', 'ASC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
            
            default:
            $resultados = Product::select('precio', 'nombre', 'link_img', 'id')
                                    ->orderBy('id', 'DESC')
                                    ->where('producto', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->paginate(20);
                break;
        }

        $multiplicador = Multiplicador::select('multiplicador')->first();

        return view('cartas', compact('resultados', 'multiplicador'));
    }
    
    public function ShowOfertas($params = null)
    {
        switch ($params) {
            case 'a-z':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('nombre', 'ASC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'z-a':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('nombre', 'DESC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'precio-mayor-menor':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('precio', 'DESC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'precio-menor-mayor':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('precio', 'ASC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
            case 'oferta-mayor-menor':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('oferta', 'DESC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'oferta-menor-mayor':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('oferta', 'ASC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'nuevos':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('id', 'DESC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            case 'no-tan-nuevos':
                $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                    ->orderBy('id', 'ASC')
                                    ->where('oferta', '>', 0)
                                    ->where('fecha_oferta', '>=', date('Y-m-d'))
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
            
            default:
            $resultados = Product::select('nombre', 'precio', 'oferta', 'fecha_oferta', 'link_img', 'id')
                                ->orderBy('id', 'DESC')
                                    ->where('oferta', '>', 0)
                                    ->where('stock', '>=', 1)
                                    ->paginate(20);
                break;
        }
        $multiplicador = Multiplicador::select('multiplicador')->first();

        return view('ofertas', compact('resultados', 'multiplicador'));
    }
    
    public function ShowOtros($params = null)
    {

        switch ($params) {
            case 'a-z':
                $resultados = Product::orderBy('nombre', 'ASC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            case 'z-a':
                $resultados = Product::orderBy('nombre', 'DESC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            case 'precio-mayor-menor':
                $resultados = Product::orderBy('precio', 'DESC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            case 'precio-menor-mayor':
                $resultados = Product::orderBy('precio', 'ASC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            case 'nuevos':
                $resultados = Product::orderBy('id', 'DESC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            case 'no-tan-nuevos':
                $resultados = Product::orderBy('id', 'ASC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
            
            default:
                $resultados = Product::orderBy('id', 'DESC')
                                    ->where('producto', '!=', 1)
                                    ->where('stock', '>=', 1)
                                    ->where('categoria', 0)
                                    ->get()
                                    ->groupBy('producto');
                                    // ->paginate(20);
                break;
        }
        $multiplicador = Multiplicador::select('multiplicador')->first();

        return view('otros', compact('resultados', 'multiplicador'));
    }

    public function FindProduct ($id)
    {
        $producto = Product::find($id);

        if (empty($producto)) {
            return abort(404);
        }

        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        return view('producto', compact('producto', 'multiplicador'));
    }

    public function ExportarProductos (ProductsExport $productsExport)
    {
        return Excel::download(new ProductsExport, 'Products.xlsx');
    }

    public function ImportarProductos(Request $request)
    {
                
        Excel::import(new ProductsImport, request()->file('file'));
        
        return redirect('/admin');
    }

    public function BuscarProducto(Request $request)
    {
        $request->validate([
            'buscandoProducto' => 'required|min:3|string',
        ], [
            'required' => 'No se está buscando nada.',
            'min' => 'Hacen falta más letras para comenzar a buscar.'
        ]);
        
        $query = $request->input('buscandoProducto');

        $resultados = Product::where('nombre', 'LIKE', "%$query%")
                                ->orWhere('descripcion', 'LIKE', "%$query%")
                                ->orWhere('idioma', 'LIKE', "%$query%")
                                ->orWhere('rareza', 'LIKE', "%$query%")
                                ->orWhere('expansion', 'LIKE', "%$query%")
                                ->orWhere('marca', 'LIKE', "%$query%")
                                ->orWhere('color', 'LIKE', "%$query%")
                                ->orWhere('oferta', 'LIKE', "%$query%")
                                ->orWhere('fecha_oferta', 'LIKE', "%$query%")
                                // ->where('stock', '>=', 1)
                                ->paginate(24)
                                ->appends(request()->except('page')); //MUCHO MUY IMPORTANTE PARA NO PERDER
                                                                    //LOS PARAMETROS PASADOS POR GET
        $multiplicador = Multiplicador::orderBy('id', 'DESC')
                                        ->select('multiplicador')
                                        ->first();

        if ($resultados->count() < 1) {
            $titulo = 'No pudimos encontrar nada.';

            return view('buscar', compact('resultados', 'titulo', 'multiplicador'));
        }

        $titulo = 'mostrando ' . $resultados->count() . ' resultados por página para: ' . $query;

        return view('buscar', compact('resultados', 'titulo', 'multiplicador'));
    }

    public function CrearProducto()
    {
        $path;   
        $messages = [
                'required' => 'El campo ":attribute" es obligatorio.',
                'active_url' => 'El link ingresado no es un link válido.',
                'unique' => 'Ya existe un producto con ese nombre.',
                'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
                'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
            ];

        $producto = request()->validate([
            'nombreProducto' => 'required|string|min:5|max:75',
            'precioProducto' => 'required|string',
            'tipoProducto' => 'required|string|min:1|max:2',
            'categoriaProducto' => 'required|string|min:1|max:2',
            'cantidadProducto' => 'required|integer',
            'estadoProducto' => 'required|string|min:4|max:15',
            'rarezaProducto' => 'nullable|string|min:4|max:20',
            'linkImagenProducto' => 'nullable|string|min:5|max:250|active_url',
            'imagenProducto' => 'nullable|file',
            'expansionProducto' => 'nullable|string|min:5|max:45',
            'tipoCartaProducto' => 'nullable|string|min:1|max:2',
            'marcaProducto' => 'nullable|string|min:4|max:15',
            'sizeProducto' => 'nullable|string|min:3|max:10',
            'capacidadProducto' => 'nullable|string|min:5|max:50',
            'idiomaProducto' => 'nullable|string|min:4|max:15',
            'colorProducto' => 'nullable|string|min:3|max:55',
            'cantidadIncluidaProducto' => 'nullable|integer',
            'ofertaProducto' => 'nullable|string|min:1|max:2',
            'fechaOfertaProducto' => 'nullable|date',
            'descripcionProducto' => 'nullable|string|min:15|max:750'
        ], $messages);

        if (!empty(request()->file('imagenProducto'))) {
            $imagen = request()->file('imagenProducto')->store("1vaU9LKXOxLh6K95FHi-YaGmGctIQx4sI", "google"); //luego de pasar las validaciones, se sube la imagen

            $path = Storage::disk('google')->url($imagen); //de esta forma se obtiene una url de google drive usable en la etiqueta <img>
        }else {
            $path = '';
        }


        Product::create([
            'nombre' => $producto['nombreProducto'],
            'producto' => $producto['tipoProducto'],
            'categoria' => $producto['categoriaProducto'],
            'stock' => $producto['cantidadProducto'],
            'precio' => $producto['precioProducto'],
            'estado' => $producto['estadoProducto'],
            'idioma' => $producto['idiomaProducto'],
            'carta_id' => $producto['tipoCartaProducto'],
            'rareza' => $producto['rarezaProducto'],
            'expansion' => $producto['expansionProducto'],
            'marca' => $producto['marcaProducto'],
            'cantidad_incluida' => $producto['cantidadIncluidaProducto'],
            'color' => $producto['colorProducto'],
            'capacidad' => $producto['capacidadProducto'],
            'size' => $producto['sizeProducto'],
            'descripcion' => $producto['descripcionProducto'],
            'oferta' => $producto['ofertaProducto'],
            'fecha_oferta' => $producto['fechaOfertaProducto'],
            'link_img' => $producto['linkImagenProducto'],
            'ubicacion_archivo_imagen' => $path,
        ]);

        return back()->withMessage('Producto creado con éxito. ' . $producto['nombreProducto']);
    }

    public function DestruirProducto($id)
    {
        $eliminar = Product::find($id);

        $eliminar->delete();

        return redirect()->route('admin.index');
    }

    public function FormEditarProducto ($id)
    {
        $producto = Product::find($id);

        return view('auth.editForm', compact('producto'));
    }

    public function EditarProducto($id)
    {
        $producto = Product::find($id);

        $path;

        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'active_url' => 'El link ingresado no es un link válido.',
            'unique' => 'Ya existe un producto con ese nombre.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $editar = request()->validate([
            'nombreProducto' => 'required|string|min:5|max:75',
            'precioProducto' => 'required|string',
            'tipoProducto' => 'required|string|min:1|max:2',
            'categoriaProducto' => 'required|string|min:1|max:2',
            'cantidadProducto' => 'required|integer',
            'estadoProducto' => 'required|string|min:4|max:15',
            'rarezaProducto' => 'nullable|string|min:4|max:20',
            'linkImagenProducto' => 'nullable|string|min:5|max:250|active_url',
            'imagenProducto' => 'nullable|file',
            'expansionProducto' => 'nullable|string|min:5|max:45',
            'tipoCartaProducto' => 'nullable|string|min:1|max:2',
            'marcaProducto' => 'nullable|string|min:4|max:15',
            'sizeProducto' => 'nullable|string|min:3|max:10',
            'capacidadProducto' => 'nullable|string|min:5|max:50',
            'idiomaProducto' => 'nullable|string|min:4|max:15',
            'colorProducto' => 'nullable|string|min:3|max:55',
            'cantidadIncluidaProducto' => 'nullable|integer',
            'ofertaProducto' => 'nullable|string|min:1|max:2',
            'fechaOfertaProducto' => 'nullable|date',
            'descripcionProducto' => 'nullable|string|min:15|max:750'
        ], $messages);

        

        if (request()->file('imagenProducto') !== null) {
            $imagen = request()->file('imagenProducto')->store("1vaU9LKXOxLh6K95FHi-YaGmGctIQx4sI", "google"); //luego de pasar las validaciones, se sube la imagen

            $path = Storage::disk('google')->url($imagen); //de esta forma se obtiene una url de google drive usable en la etiqueta <img>

            $producto->ubicacion_archivo_imagen = $path;//hay que hacerlo desde aca, por q al setear path como '' se guarda igual en la base de datos
        }

            $producto->nombre = $editar['nombreProducto'];
            $producto->producto = $editar['tipoProducto'];
            $producto->categoria = $editar['categoriaProducto'];
            $producto->stock = $editar['cantidadProducto'];
            $producto->precio = $editar['precioProducto'];
            $producto->estado = $editar['estadoProducto'];
            $producto->idioma = $editar['idiomaProducto'];
            $producto->carta_id = $editar['tipoCartaProducto'];
            $producto->rareza = $editar['rarezaProducto'];
            $producto->expansion = $editar['expansionProducto'];
            $producto->marca = $editar['marcaProducto'];
            $producto->cantidad_incluida = $editar['cantidadIncluidaProducto'];
            $producto->color = $editar['colorProducto'];
            $producto->capacidad = $editar['capacidadProducto'];
            $producto->size = $editar['sizeProducto'];
            $producto->descripcion = $editar['descripcionProducto'];
            $producto->oferta = $editar['ofertaProducto'];
            $producto->fecha_oferta = $editar['fechaOfertaProducto'];
            $producto->link_img = $editar['linkImagenProducto'];

            $producto->save();

        return redirect(route('admin.index'))->withMessage('Producto editado con éxito. ' . $editar['nombreProducto']);
    }
}
