<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Multiplicador;
use App\Cupon;
use App\OrdenCompra;
use App\Compra;
use App\User;
use App\TypeProduct;
use App\TypeCarta;
use App\Category;
use App\Paquete;
use App\Pedido;
use App\ZonaEnvio;
use App\MetodoEnvio;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\VentasAllExport;
use App\Exports\VentasMesExport;

use Auth;
use Validator;

use App\Mail\MailPedidoImportacion;
use App\Mail\MailPaqueteRevisado;
use App\Mail\MailPedidoRealizado;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() 
    {
        $dolar = Multiplicador::all();

        $typeProducts = TypeProduct::all();

        $typeCartas = TypeCarta::all();

        $categories = Category::all();

        $paquetesParaImportar = Paquete::where('estado', 'Cerrado y Tramitando Importación')->paginate(20);

        $paquetesImportandose = Paquete::where('estado', 'En Camino')->get();
        
        return view('auth.admin', compact('dolar', 'typeProducts', 'typeCartas', 'categories', 'paquetesParaImportar', 'paquetesImportandose'));
    }

    public function VisualizarCompras()
    {
        $ordenes = OrdenCompra::select(
                                        'id', 
                                        'username', 
                                        'fecha', 
                                        'forma_de_pago', 
                                        'monto_total', 
                                        'envio'
                                    )
                                    ->where('finalizada', true)
                                    ->where('es_pedido', false)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(50);
        
        return view('auth.ordenes-compra', compact('ordenes'));
    }

    public function DetalleCompra($username, $ordenCompra)
    {
        $compras = Compra::select('producto', 'id_producto', 'precio_unidad', 'unidades_compradas')->where('orden_compra', $ordenCompra)->get();

        $detallesUsuario = User::where('username', $username)->first();

        $ordenDeCompra = OrdenCompra::where('id', $ordenCompra)->first();

        return view('auth.detalle-venta', compact('compras', 'detallesUsuario', 'ordenDeCompra'));
    }

    public function GenerarCupon()
    {
        $message = [
            'required' => 'Hay que llenar los 2 campos.',
            'unique' => 'Ya hay un cupon identico.',
            'after' => 'La fecha ingresada ya pasó.',
            'date_format' => 'El formato de la fecha es incorrecto, debe ser: "aaaa-mm-dd".',
        ];

        $generarCupon = request()->validate([
            'fechaCupon' => 'required|date|unique:App\Product,nombre|after:' . date('Y-m-d') . '|date_format:Y-m-d',
            'descuentoCupon' => 'required|string|min:1|max:3'
        ], $message);

        $couponCode = "YGOPEP-" . $generarCupon['descuentoCupon']. "-" . strtotime($generarCupon['fechaCupon']);

        Cupon::create([
            'codigo' => $couponCode,
            'porcentaje' => '-' . $generarCupon['descuentoCupon'] . '%',
            'tipo' => 'discount',
            'nombre' => 'Descuento exclusivo de Yu-Gi-Oh! Para El Pueblo',
            'fecha' => $generarCupon['fechaCupon'] 
        ]);

        return back()->withMessage('Cupón generado con éxito. ' . $couponCode);
    }

    public function ShowCupon()
    {
        $cupones = Cupon::select('codigo', 'fecha')->where('fecha', '>=', date('Y-m-d'))->get();

        return back()->with(['cupones' => $cupones]);
    }

    public function ComprasExcelTodo()
    {
        return Excel::download(new VentasAllExport, 'historial completo de ventas.xlsx');
    }

    public function AgregarDinero($idOrden, Request $request)
    {
        $orden = OrdenCompra::find($idOrden);

        $botonMP = request()->get('boton');

        $orden->agregar_dinero_envio = $botonMP;

        $orden->save();

        return redirect()->back();
    }

    public function listaPaquetesPedidos()
    {
        $paquetes = Paquete::where('estado', 'Revisando')->paginate(20);

        return view('auth.paquetes.admin-paquetes', compact('paquetes'));
    }

    public function detallePaquetePedido($idPaquete)
    {
        $paquete = Paquete::find($idPaquete);

        $usuario = User::where('username', $paquete->username)->first();

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

            return view('auth.paquetes.paquete-freezado', compact('pedidos', 'paquete', 'montoTotal', 'pagoInicial', 'usuario', 'ordenCompra'));
        } else 
        {
            return view('auth.paquetes.admin-detalle-paquete', compact('pedidos', 'paquete', 'montoTotal', 'pagoInicial', 'usuario'));
        }
    }

    public function revisarPaquete(Request $request, $idPaquete)
    {
        $campos = $request->all();

        $validator = Validator::make($campos, [
            'comentarioAlPaquete' => 'nullable|string|max:190',
            'fechaCaducudadPrecio' => 'required|after:' . date('Y-m-d'),
        ]);

        if($validator->fails())
        {
            return back()->withMessage('Hubo un error, asegurate de que ningun comentario tenga más de 190 caractéres, y de que la fecha en la que caduca el presupuesto no haya pasado ya');
        }

        $array = array();

        foreach ($campos as $campo) 
        {
            if (is_array($campo)) 
            {
                array_push($array, $campo);
            }
        }

        for ($i=0; $i < count($array); $i++) 
        { 
            $pedido = Pedido::find($array[$i][0]);

            if (is_null($pedido)) 
            {
                return back()->withMessage('Hubo un error, uno de los pedidos en este paquete no existe en la base de datos.');
            }

            $pedido->precio = $array[$i][1];

            $pedido->cantidad = $array[$i][2];

            $pedido->comentario = $array[$i][3];

            $pedido->save();
        }

        $paquete = Paquete::find($idPaquete);

        $paquete->comentario_al_paquete = $campos['comentarioAlPaquete'];

        $paquete->fecha_caducidad_precio = $campos['fechaCaducudadPrecio'];

        $paquete->estado = 'Abierto y Confirmado';

        $paquete->save();

        $notifyUser = User::select('email')->where('username', $paquete->username)->first();

        Mail::to($notifyUser->email)->send(new MailPaqueteRevisado);

        return redirect()->route('admin.list-pakages');
    }

    public function notificarPedidoRealizado($idPaquete)
    {
        $paquete = Paquete::find($idPaquete);

        $paquete->estado = 'En Camino';

        $paquete->seguimiento_envio = 'Ya se realizó el pedido de importación';

        $paquete->save();

        $notifyUser = User::select('email')->where('username', $paquete->username)->first();

        Mail::to($notifyUser->email)->send(new MailPedidoRealizado($idPaquete, 0));

        return back()->withMessage('Notificación realizada con éxito.');
    }

    public function notificarSeguimientoEnvio(Request $request)
    {
        $campos = $request->only('seguimiento-envio', 'id-paquete');

        $validator = Validator::make($campos, [
            'seguimiento-envio' => 'required|string',
            'id-paquete' => 'required|integer|exists:paquetes,id',
        ]);

        if($validator->fails())
        {
            return back()->withErrors('Revisa los datos, es posible que no hayas completado correctamente algún formulario');
        }

        $estadoEnvio = [
            'El Paquete ya fue pedido',
            'El Paquete ya fue despachado de su país de origen',
            'El paquete ya ingresó a Argentina',
            'El paquete ya está listo para la entrega'
        ];

        $paquete = Paquete::find($campos['id-paquete']);

        $paquete->seguimiento_envio = $estadoEnvio[$campos['seguimiento-envio']];

        $paquete->save();

        $notifyUser = User::select('email')->where('username', $paquete->username)->first();

        Mail::to($notifyUser->email)->send(new MailPedidoRealizado($campos['id-paquete'], $campos['seguimiento-envio']));

        return back()->withMessage('Seguimiento de envío notificado conéxito');
    }

    public function borrarMetodo($idMetodo)
    {
        MetodoEnvio::find($idMetodo)->delete();

        return back()->withMessage('Método de envío eliminado con éxito');
    }
    
    public function borrarZona($idZona)
    {
        ZonaEnvio::find($idZona)->delete();

        return back()->withMessage('Zona de envío eliminada con éxito');
    }

    public function crearZonaEnvio(Request $request)
    {
        $campos = $request->only('zona', 'precio', 'metodoEnvio');

        $validator = Validator::make($campos, [
            'zona' => 'required|string|max:190',
            'precio' => 'required|integer|min:10',
            'metodoEnvio' => 'required|integer|exists:metodos_de_envio,id',
        ]);

        if($validator->fails())
        {
            return back()->withErrors('Revisa los datos, es posible que no hayas completado correctamente algún formulario');
        }

        ZonaEnvio::create([
            'metodo_envio' => $campos['metodoEnvio'],
            'zona' => $campos['zona'],
            'precio' => $campos['precio'],
        ]);

        return back()->withMessage('Zona de Envios creada con éxito.');
    }
    
    public function crearMetodoEnvio(Request $request)
    {
        $campos = $request->only('metodo', 'tiempoPrevisto');

        $validator = Validator::make($campos, [
            'metodo' => 'required|string|max:190',
            'tiempoPrevisto' => 'required|string|max:190',
        ]);

        if($validator->fails())
        {
            return back()->withErrors('Revisa los datos, es posible que no hayas completado correctamente algún formulario');
        }

        MetodoEnvio::create([
            'metodo' => $campos['metodo'],
            'tiempo_previsto' => $campos['tiempoPrevisto'],
        ]);

        return back()->withMessage('Método de Envios creada con éxito.');
    }
    
    public function editarZonaEnvio(Request $request)
    {
        $campos = $request->only('zona', 'precio', 'metodoEnvio', 'id-zona');

        $validator = Validator::make($campos, [
            'zona' => 'required|string|min:5|max:190',
            'precio' => 'required|integer|min:10',
            'metodoEnvio' => 'required|integer|exists:metodos_de_envio,id',
            'id-zona' => 'required|integer|exists:zonas_de_envio,id',
        ]);

        if($validator->fails())
        {
            return back()->withErrors('Revisa los datos, es posible que no hayas completado correctamente algún formulario');
        }

        $editarZona = ZonaEnvio::find($campos['id-zona']);

        $editarZona->metodo_envio = $campos['metodoEnvio'];
        $editarZona->zona = $campos['zona'];
        $editarZona->precio = $campos['precio'];
        
        $editarZona->save();

        return back()->withMessage('Zona de envíos editada con éxito.');
    }
    
    public function editarMetodoEnvio(Request $request)
    {
        $campos = $request->only('id-metodo', 'metodo', 'tiempoPrevisto');

        $validator = Validator::make($campos, [
            'id-metodo' => 'required|integer|exists:metodos_de_envio,id',
            'metodo' => 'required|string|min:5',
            'tiempoPrevisto' => 'required|string|min:10',
        ]);

        if($validator->fails())
        {
            return back()->withErrors('Revisa los datos, es posible que no hayas completado correctamente algún formulario');
        }

        $editarMetodo = MetodoEnvio::find($campos['id-metodo']);

        $editarMetodo->metodo = $campos['metodo'];
        $editarMetodo->tiempo_previsto = $campos['tiempoPrevisto'];

        $editarMetodo->save();

        return back()->withMessage('Método de envío editado con éxito.');
    }
}
