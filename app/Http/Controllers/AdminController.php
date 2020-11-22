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

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\VentasAllExport;
use App\Exports\VentasMesExport;

use Auth;

class AdminController extends Controller
{
    public function index() 
    {
        $dolar = Multiplicador::all();

        $typeProducts = TypeProduct::all();

        $typeCartas = TypeCarta::all();

        $categories = Category::all();
        
        return view('auth.admin', compact('dolar', 'typeProducts', 'typeCartas', 'categories'));
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

        // dd($generarCupon['fechaCupon']);

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

    public function NotificarPedidoDeCartas(Request $request)
    {
        return redirect()->route('home', Auth::user()->username);
    }
}
