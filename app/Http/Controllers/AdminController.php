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

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\VentasAllExport;
use App\Exports\VentasMesExport;

use Auth;
use Validator;

use App\Mail\MailPedidoImportacion;
use App\Mail\MailPaqueteRevisado;
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
        
        return view('auth.admin', compact('dolar', 'typeProducts', 'typeCartas', 'categories', 'paquetesParaImportar'));
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

        return view('auth.paquetes.admin-detalle-paquete', compact('pedidos', 'paquete', 'montoTotal', 'pagoInicial', 'usuario'));
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

        Mail::to('mr.corvy@gmail.com')->send(new MailPaqueteRevisado);

        return redirect()->route('admin.list-pakages');
    }
}
