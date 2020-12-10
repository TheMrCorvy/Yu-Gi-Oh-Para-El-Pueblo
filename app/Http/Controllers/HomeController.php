<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

use DB;


use App\OrdenCompra;
use App\Compra;
use App\Product;
use App\Multiplicador;
use App\User;
use App\Paquete;
use App\Pedido;

use Cart;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailVendedor;

use App\ZonaEnvio;

class HomeController extends Controller
{
    public function index()
    {
        $multiplicador = Multiplicador::select('multiplicador')->first();

        $ofertas = Product::orderBy('id', 'DESC')
                            ->where('oferta', '>', 0)
                            ->where('stock', '>=', 1)
                            ->where('fecha_oferta', '>=', date('Y-m-d'))
                            ->take(12)
                            ->get();

        return view('welcome', compact('ofertas', 'multiplicador'));
    }

    public function viewImportarCartas()
    {
        $paquetes = Paquete::where('username', Auth::user()->username)->orderBy('id', 'DESC')->get();

        return view('auth.paquetes.mis-paquetes', compact('paquetes'));
    }

    public function detallePaquete($idPaquete)
    {
        $paquete = Paquete::find($idPaquete);

        if (is_null($paquete) || $paquete->username !== Auth::user()->username) 
        {
            return view('errors.404');
        }

        $pedidos = Pedido::where('paquete', $idPaquete)->get();

        $montoTotal = 0;

        foreach ($pedidos as $pedido) 
        {
            if ($pedido->precio) 
            {
                $montoTotal = $montoTotal + ($pedido->precio * $pedido->cantidad);
            }
        }

        $pagoInicial = $montoTotal / 10;

        if ($paquete->estado === 'En Camino') 
        {
            $ordenCompra = OrdenCompra::find($paquete->orden_compra);

            $usuario = User::where('username', $paquete->username)->first();

            return view('auth.paquetes.paquete-freezado', compact('pedidos', 'paquete', 'montoTotal', 'pagoInicial', 'usuario', 'ordenCompra'));
        } else 
        {
            return view('auth.paquetes.detalle-paquete', compact('pedidos', 'paquete', 'montoTotal', 'pagoInicial'));
        }
    }

    public function Checkout()
    {
        if (null !== auth()->id()) {
            $productosEnCarrito = \Cart::session(auth()->id())->getContent();
        }else{
            $productosEnCarrito = '';
        }

        $usuario = User::where('username', Auth::user()->username)->first();

        return view('auth.checkout', compact('productosEnCarrito', 'usuario'));
    }

    public function ComprarAhora($idProducto)
    {
        $producto = Product::find($idProducto);

        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        if (Cart::session(auth()->id())->get($producto->id)) {
            return redirect()->back();
        }//hay que verificar si el producto a añadir está de hecho en el carrito, esto para evitar que se compre más de lo q se tiene stock

        if ($producto->oferta > 0 && $producto->fecha_oferta >= date('Y-m-d')) 
        {
            $precioOferta = ($producto->oferta / 100) * $producto->precio;
            $restar = $producto->precio - $precioOferta;

            $precioReal = $restar * $multiplicador->multiplicador;

            Cart::session(auth()->id())->add(array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => floor($precioReal), //round va a redondear los valores al valor original en algunos casos (si el valor original es 30, y round recibe 28, va a dejarlo otra vez en 30) en cambio floor, lo que hace es cortar los números después de la coma
                'quantity' => 1,
                'attributes' => array($producto->link_img, $producto->stock),
                'associatedModel' => $producto,
            ));
        }else {
            // poner el \Cart me permite usarlo sin tener que importarlo, porque al importarlo tira un error de que no puede ser llamado desde un método estático
            $precioReal = $producto->precio * $multiplicador->multiplicador;

            Cart::session(auth()->id())->add(array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => round($precioReal, -1),
                'quantity' => 1,
                'attributes' => array($producto->link_img, $producto->oferta, $producto->fecha_oferta, $producto->stock),
                'associatedModel' => $producto,
            ));
        }

        return redirect()->route('Checkout');
    }

    public function PasoUno(Request $request)
    {
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $primerPaso = request()->validate([
            'nombre' => 'required|min:5|max:50|string',
            'email' => 'nullable|min:5|max:50|email',
            'telefono' => 'nullable|min:5|max:50|string',
            'dni' => 'required|min:6|max:10|string',
            'calle' => 'required|min:5|max:80|string',
            'altura' => 'required|integer',
            'provincia' => 'required|min:3|max:25|string',
            'ciudad' => 'required|min:3|max:30|string',
            'codigoPostal' => 'required|integer',
            'envio' => 'required|in:1,0',
        ], $messages);

        $usuario = User::where('username', Auth::user()->username)->first();

        if (!empty($primerPaso['email'])) {
            $usuario->email = $primerPaso['email'];
        }

        if (!empty($primerPaso['telefono'])) {
            $usuario->num_telefono = $primerPaso['telefono'];
        }

        $usuario->save();

        $ordenCompra = OrdenCompra::create([
            'username' => $usuario->username,
            'fecha' => date('Y-m-d'),
            'monto_total' => floor(Cart::session(auth()->id())->getTotal()),
            'nombre' => $primerPaso['nombre'],
            'dni' => $primerPaso['dni'],
            'calle' => $primerPaso['calle'],
            'altura' => $primerPaso['altura'],
            'provincia' => $primerPaso['provincia'],
            'ciudad' => $primerPaso['ciudad'],
            'codigo_postal' => $primerPaso['codigoPostal'],
            'envio' => $primerPaso['envio'],
            'finalizada' => false,
        ]);

        OrdenCompra::where('finalizada', false)->whereMonth('fecha', '<=', now()->subMonth()->month)->delete();

        if ($primerPaso['envio']) 
        {
            $envios = ZonaEnvio::join('metodos_de_envio', 'zonas_de_envio.metodo_envio', '=', 'metodos_de_envio.id')
                                ->select(
                                    'zonas_de_envio.id as id_zona',
                                    'zonas_de_envio.zona',
                                    'zonas_de_envio.precio',
                                    'metodos_de_envio.metodo',
                                    'metodos_de_envio.tiempo_previsto',
                                    'metodos_de_envio.id as id_metodo'
                                )
                                ->get()
                                ->groupBy('metodo');

            return back()->with(['formulario' => '2', 'ordenCompra' => $ordenCompra->id, 'usuario' => $usuario, 'envios' => $envios]);
        }

        return back()->with(['formulario' => '3', 'ordenCompra' => $ordenCompra->id, 'usuario' => $usuario]);
    }

    public function PasoDos(Request $request)
    {
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $segundoPaso = request()->validate([
            'ordenCompra' => 'required|min:1|max:5|string',
            'calle1' => 'required|min:5|max:50|string',
            'calle2' => 'nullable|min:3|max:15|string',
            'altura' => 'required|integer',
            'barrio' => 'nullable|min:5|max:15|string',
            'ciudad' => 'required|min:4|max:25|string',
            'provincia' => 'required|min:5|max:25|string',
            'metodoEnvio' => 'required|string|min:32|max:48',
        ], $messages);

        $usuario = User::where('username', Auth::user()->username)->first();

        $usuario->calle1_timbre = $segundoPaso['calle1'];
        $usuario->calle2 = $segundoPaso['calle2'];
        $usuario->altura_domicilio = $segundoPaso['altura'];
        $usuario->barrio = $segundoPaso['barrio'];
        $usuario->ciudad = $segundoPaso['ciudad'];
        $usuario->localidad = $segundoPaso['provincia'];

        $usuario->save();

        $ordenCompra = OrdenCompra::find($segundoPaso['ordenCompra']);
        $ordenCompra->metodo_envio = $segundoPaso['metodoEnvio'];
        $ordenCompra->save();

        return back()->with(['formulario' => '3', 'ordenCompra' => $segundoPaso['ordenCompra'], 'usuario' => $usuario]);
    }

    //paso tres es ya realizar la compra asi q esta en compras controller

    public function destroy($ordenCompra)
    {
        $destruir = OrdenCompra::where('id', $ordenCompra)->first();

        $destruir->delete();

        return redirect()->route('Landing');
    }
}
