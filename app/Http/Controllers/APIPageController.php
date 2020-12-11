<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Multiplicador;
use App\Category;
use App\Compra;
use App\OrdenCompra;
use App\Cupon;
use App\CuponUser;
use App\TypeCarta;
use App\TypeProduct;
use App\User;
use App\Paquete;
use App\Pedido;
use App\ZonaEnvio;
use App\MetodoEnvio;

use Auth;

use Validator;

use Cart;

class APIPageController extends Controller
{
//buscar producto for admin
    public function BuscarProducto($query)
    {
        $pedido = trim($query);

        $resultados = Product::where('nombre', 'LIKE', '%' . $pedido . '%' )
                                ->orWhere('descripcion', 'LIKE', "%$query%")
                                ->orWhere('idioma', 'LIKE', "%$query%")
                                ->orWhere('rareza', 'LIKE', "%$query%")
                                ->orWhere('expansion', 'LIKE', "%$query%")
                                ->orWhere('marca', 'LIKE', "%$query%")
                                ->orWhere('color', 'LIKE', "%$query%")
                                ->orWhere('oferta', 'LIKE', "%$query%")
                                ->orWhere('fecha_oferta', 'LIKE', "%$query%")
                                ->orderBy('nombre', 'ASC')
                                ->take(10)
                                ->get();

        return view('sections.resultados-productos', compact('resultados'));
    }

//los singles, los nuevos, y los accesorios de home
    public function GetNuevosHome()
    {
        $multiplicador = Multiplicador::select('multiplicador')->first();

        $novedades = Product::orderBy('id', 'DESC')
                            ->where('stock', '>=', 1)
                            ->take(20)->get();

        return view('sections.ajax.nuevos-productos', compact('multiplicador', 'novedades'));
    }

    public function GetSinglesHome()
    {
        $multiplicador = Multiplicador::select('multiplicador')->first();

        $singles = Product::orderBy('id', 'DESC')
                            ->where('producto', '=', 1)
                            ->where('stock', '>=', 1)
                            ->take(4)
                            ->get();

        return view('sections.ajax.singles', compact('singles', 'multiplicador'));
    }

    public function GetAccesoriosHome()
    {
        $otros = Product::join('type_products', 'type_products.id', '=', 'products.producto')
                            ->select('products.nombre', 'products.link_img', 'type_products.tipo_producto as producto', 'products.id')
                            ->orderBy('products.id', 'DESC')
                            ->where('products.producto', '!=', 1)
                            ->where('products.stock', '>=', 1)
                            ->where('products.categoria', 0)
                            ->take(4)
                            ->get();

        return view('sections.ajax.accesorios', compact('otros'));
    }

//el banner de las imagenes en la vista producto
    public function GetCarousel($id) //ver el carrusel de imagenes en la vista producto
    {
        $imagenes = Product::select('link_img', 'ubicacion_archivo_imagen')->where('id', $id)->first();

        return view('sections.ajax.banner-product', compact('imagenes'));
    }

//productos recomendados
    public function GetRecomendaciones()
    {
        $ofertas = Product::select('id', 'nombre', 'link_img', 'precio', 'oferta', 'fecha_oferta')
                            ->where('oferta', '>', 0)
                            ->where('stock', '>=', 1)
                            ->where('fecha_oferta', '>=', date('Y-m-d'))
                            ->orderBy('id', 'DESC')
                            ->take(4)
                            ->get();
        
        $productos = Product::select('id', 'nombre', 'link_img', 'precio', 'oferta', 'fecha_oferta')
                            ->where('stock', '>=', 1)
                            ->orderBy('id', 'DESC')
                            ->take(4)
                            ->get();

        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        if ($ofertas->count() < 4) {
            return view('sections.ajax.recomendaciones', compact('multiplicador'))->with('recomendaciones', $productos);
        }

        return view('sections.ajax.recomendaciones', compact('multiplicador'))->with('recomendaciones', $ofertas);
    }

//usuario compras y detalles
    public function MisCompras($username) 
    {
        $compras = OrdenCompra::select(
                                        'id', 
                                        'fecha', 
                                        'forma_de_pago', 
                                        'monto_total', 
                                        'envio', 
                                        'agregar_dinero_envio'
                                )
                                ->where('username', $username)
                                ->where('finalizada', true)
                                ->where('es_pedido', false)
                                ->orderBy('id', 'DESC')
                                ->get();
                            
        return view('sections.ajax.orden-de-compra', compact('compras'));
    }

    public function MisDetalles($ordenCompra)
    {
        $productos = Compra::select('producto', 'id_producto', 'precio_unidad', 'unidades_compradas')->where('orden_compra', $ordenCompra)->get();
        
        return view('sections.ajax.productos-comprados', compact('productos'));
    }

// categorias navbar
    public function ObtainCategories()
    {
        $categories = Category::select('ruta', 'categoria')->where('id', '>', 1)->get();
        
        return view('sections.ajax.categorias-navbar', compact('categories'));
    }
    
// añadir pedido al paquete
    public function addToPakage(Request $request)
    {
        $pakageData = $request->only('nombre', 'username', 'expansion', 'cantidad');

        $validator = Validator::make($pakageData, [
            'username' => 'required|string|exists:users,username',
            'nombre' => 'required|string|min:4|max:190',
            'expansion' => 'nullable|string|min:4|max:190',
            'cantidad' => 'required|integer|min:1|max:190',
        ], [
            'required' => 'Este campo no puede estar vacío',
            'string' => 'Este campo debe ser una cadena de caracteres',
            'integer' => 'Este campo debe ser un número entero',
            'min' => 'No se ha alcanzado el mínimo de este campo',
            'max' => 'El máximo posible para este campo son 190 caracteres',
            'exists' => 'El usuario/paquete no existe',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()
            ], 200);
        }

        try 
        {
            $paquete = Paquete::where('username', $pakageData['username'])->where('estado', 'LIKE', '%Abierto%')->first();

            if (is_null($paquete)) 
            {
                $paquete = Paquete::create([
                    'username' => $pakageData['username'],
                    'estado' => 'Abierto'
                ]);
            }

            if ($paquete->estado !== "Abierto")
            {
                $paquete->estado = "Abierto";

                $paquete->save();
            }

            $pedido = Pedido::create([
                'paquete' => $paquete->id,
                'username' => $pakageData['username'],
                'nombre_carta' => $pakageData['nombre'],
                'expansion' => $pakageData['expansion'],
                'cantidad' => $pakageData['cantidad'],
            ]);

            return response()->json([
                'message' => 'datos recibidos',
                'paquete' => $paquete,
                'carta' => $pedido,
                'datos' => request()->all()
            ], 200);

        } catch (\Throwable $err) 
        {
            return response()->json([
                'err' => $err->getMessage()
            ], 500);
        }
    }

    public function modificarCantidades(Request $request)
    {
        $dataPedido = $request->only('idCarta', 'username', 'accion');

        $validator = Validator::make($dataPedido, [
            'username' => 'required|string|exists:users,username',
            'idCarta' => 'required|integer|exists:cartas_pedidas,id',
            'accion' => 'required|string|min:5|max:6'
        ], [
            'required' => 'Este campo no puede estar vacío',
            'string' => 'Este campo debe ser una cadena de caracteres',
            'integer' => 'Este campo debe ser un número entero',
            'min' => 'No se ha alcanzado el mínimo de este campo',
            'max' => 'El máximo posible para este campo son 190 caracteres',
            'exists' => 'La carta no existe',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()
            ], 200);
        }

        $pedidoCarta = Pedido::where('username', $dataPedido['username'])->where('id', $dataPedido['idCarta'])->first();

        if (is_null($pedidoCarta)) 
        {
            return response()->json([
                'errors' => 'Carta no encontrada'
            ], 404);
        }

        $paquete = Paquete::find($pedidoCarta->paquete);

        if ($paquete->estado === "Revisando") 
        {
            return response()->json([
                'errors' => 'No se puede alterar el contenido de un paquete mientras se revisa.'
            ], 200);
        }

        if ($dataPedido['accion'] === "sumar") 
        {
            if ($pedidoCarta->cantidad <= 0) 
            {
                return response()->json([
                    'errors' => 'No hay stock'
                ], 400);
            }
            $pedidoCarta->cantidad = $pedidoCarta->cantidad +1;

            $pedidoCarta->save();

            if ($paquete->estado !== "Abierto")
            {
                $paquete->estado = "Abierto";

                $paquete->save();
            }

            return response()->json([
                'nueva_cantidad_carta' => $pedidoCarta->cantidad,
                'id_carta_pedida' => $pedidoCarta->id,
                'nuevo_estado_paquete' => "Abierto",
            ], 200);

        } elseif ($dataPedido['accion'] === "restar") 
        {
            $pedidoCarta->cantidad = $pedidoCarta->cantidad -1;

            if ($pedidoCarta->cantidad <= 0) 
            {
                $pedidoCarta->delete();

                return response()->json([
                    'carta_removida' => $dataPedido['idCarta'],
                ], 200);
            }else 
            {
                $pedidoCarta->save();
            }

        }else {
            return response()->json([
                'errors' => 'Carta no encontrada'
            ], 404);
        }

        return response()->json([
            'nueva_cantidad_carta' => $pedidoCarta->cantidad,
            'id_carta_pedida' => $pedidoCarta->id,
        ], 200);
    }

    public function getMetodosEnvio()
    {
        $envios = cache()->remember('info-envios', 60*60*24*3, function()
        {   
            $metodos = MetodoEnvio::select('metodo', 'id', 'tiempo_previsto')->get();

            $zonas = ZonaEnvio::select('metodo_envio', 'id', 'zona', 'precio')->get();

            return [
                'metodos' => $metodos,
                'zonas' => $zonas,
            ];
        });

        return response()->json($envios, 200);
    }

    public function getInfoEnvios()
    {
        $enviosCacheados = cache()->remember('info-envios-cart', 60*60*24*3, function()
        {   
            $envios = ZonaEnvio::join('metodos_de_envio', 'zonas_de_envio.metodo_envio', '=', 'metodos_de_envio.id')
                                ->select(
                                    'zonas_de_envio.zona',
                                    'zonas_de_envio.precio',
                                    'metodos_de_envio.metodo',
                                    'metodos_de_envio.tiempo_previsto',
                                )
                                ->get()
                                ->groupBy('metodo');
            return $envios;
        });

        return view('sections.ajax.info-envios', compact('enviosCacheados'));
    }
}
