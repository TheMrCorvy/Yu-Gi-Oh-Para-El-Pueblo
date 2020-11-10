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

use Auth;

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
        $compras = OrdenCompra::select('id', 'fecha', 'forma_de_pago', 'monto_total', 'envio', 'agregar_dinero_envio')->where('username', $username)->orderBy('id', 'DESC')->get();
                            
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
}
