<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\ConsumesExternalServices; //importo el trait de guzzle que hizo manualmente el colombiando del tutorial

use Auth;

use Cart;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailVendedor;
use App\Mail\MailPedidoEncargado;
use App\Mail\MailPagoFinalRealizado;

use App\Product;
use App\Compra;
use App\OrdenCompra;
use App\Cupon;
use App\CuponUser;
use App\Paquete;

class ComprasController extends Controller
{
    use ConsumesExternalServices; //lo instancio dentro de la clase para poder llamar a su metodo

    protected $baseUri;

    protected $key;

    protected $secret;

    protected $baseCurrency;

    protected $converter;

    public function __construct()
    {
        $this->baseUri = config('services.mercadopago.base_uri'); 
        $this->key = config('services.mercadopago.key');
        $this->secret = config('services.mercadopago.secret');
        $this->baseCurrency = config('services.mercadopago.base_currency');

        $this->converter = 'ars';
    }

    public function PagoEfectivo($ordenCompra)
    {
        if (session()->has('pagando_seña')) 
        {
            $paquete = Paquete::find(session()->get('pagando_seña'));

            if (!($paquete->fecha_caducidad_precio >= now()->format('Y-m-d')) && !is_null($paquete->fecha_caducidad_precio)) 
            {
                return redirect()
                ->route('Administrar Paquete', $paquete->id)
                ->withMessage(
                    'Ya pasó la fecha límite en la que podías pagar la seña para este paquete. Tendrás que enviarlo a revisión nuevamente para que podamos darte un precio actualizado.'
                );
            }

            $ordenFinalizada = $this->finalizarOrdenCompra($ordenCompra, 'Pago en Efectivo', ceil(Cart::session(auth()->id())->getTotal()));
            
            if (session()->has('pago_final')) 
            {
                $paquete->estado = 'Finalizado';

                Mail::to('mr.corvy@gmail.com')->send(new MailPagoFinalRealizado);

                session()->forget('pago_final');
            } else 
            {
                $paquete->estado = 'Cerrado y Tramitando Importación';

                Mail::to('mr.corvy@gmail.com')->send(new MailPedidoEncargado);
            }
            
            $paquete->orden_compra = $ordenFinalizada->id;

            $paquete->fecha_caducidad_precio = null;

            $paquete->save();

            session()->forget('pago_inicial');

            Cart::session(auth()->id())->clear();

            Cart::session(auth()->id())->clearCartConditions();

            return redirect()->route('Importar Cartas');
        } else 
        {
            $productosComprados = Cart::session(auth()->id())->getContent();

            $this->AplicarCupon('-5%'); //se hace el 5% de descuento en efectivo
            
            if ($this->GenerarProductosComprados($ordenCompra, $productosComprados)) 
            {
                $this->finalizarOrdenCompra($ordenCompra, 'Pago en Efectivo');

                if ($this->ReducirStock($productosComprados)) {
                    Cart::session(auth()->id())->clear();

                    Cart::session(auth()->id())->clearCartConditions(); //hay que quitar el descuento en efectivo
                    
                    Mail::to('mr.corvy@gmail.com')->send(new MailVendedor);
        
                    return redirect()->route('home', Auth::user()->username);
                }
                return abort(500);
            }
            return abort(500);
        }
    }

    private function finalizarOrdenCompra($ordenCompra, $formaDePago, $pagoInicial = null)
    {
        $finalizarOrden = OrdenCompra::where('id', $ordenCompra)->where('username', Auth::user()->username)->first();
        
        $finalizarOrden->forma_de_pago = $formaDePago;
        $finalizarOrden->fecha = date('Y-m-d');
        $finalizarOrden->finalizada = true;
        $finalizarOrden->es_pedido = !is_null($pagoInicial) ? true : false;

        $finalizarOrden->save();

        return $finalizarOrden;
    }

    public function PagoOnline(Request $request)
    {
        $messages = [
            'required' => 'El campo ":attribute" es obligatorio.',
            'min' => 'No se ha alcanzado la cantidad mínima de caractéres.',
            'max' => 'Se ha excedido la cantidad máxima de caractéres permitidos.'
        ];

        $datosTarjeta = request()->validate([
            'card_network' => 'required',
            'card_token' => 'required',
            'email' => 'required|min:3|max:40|email',
            'installments' => 'required|min:1|integer',
            'ordenCompra' => 'required|integer|exists:ordenes_compras,id',
            'cupon' => 'nullable|string|min:10|max:30',
        ], $messages);
        
        if (session()->has('pagando_seña')) 
        {
            $paquete = Paquete::find(session()->get('pagando_seña'));

            if (!($paquete->fecha_caducidad_precio >= now()->format('Y-m-d')) && !is_null($paquete->fecha_caducidad_precio)) 
            {
                return redirect()
                ->route('Administrar Paquete', $paquete->id)
                ->withMessage(
                    'Ya pasó la fecha límite en la que podías pagar la seña para este paquete. Tendrás que enviarlo a revisión nuevamente para que podamos darte un precio actualizado.'
                );
            }
        }else
        {
            $this->AplicarCupon($datosTarjeta['cupon']);
        }

        $pagando = $this->CrearPeticionPagoMP(
            $request->card_network,//visa, mastercard, etc
            $request->card_token,//los datos codificados de la tarjeta de crédito
            $request->email,
            $request->installments//cantidad de cuotas
        );

        if ($pagando->status === "approved") 
        {
            if (session()->has('pagando_seña')) 
            {
                $ordenFinalizada = $this->finalizarOrdenCompra($datosTarjeta['ordenCompra'], 'Pago Online con MercadoPago', ceil(Cart::session(auth()->id())->getTotal()));

                $paquete = Paquete::find(session()->get('pagando_seña'));

                if (session()->has('pago_final')) 
                {
                    $paquete->estado = 'Finalizado';

                    Mail::to('mr.corvy@gmail.com')->send(new MailPagoFinalRealizado);

                    session()->forget('pago_final');
                } else 
                {
                    $paquete->estado = 'Cerrado y Tramitando Importación';

                    Mail::to('mr.corvy@gmail.com')->send(new MailPedidoEncargado);
                }

                $paquete->orden_compra = $ordenFinalizada->id;

                $paquete->fecha_caducidad_precio = null;

                $paquete->save();

                session()->forget('pagando_seña');

                Cart::session(auth()->id())->clear();

                Cart::session(auth()->id())->clearCartConditions();

                return redirect()->route('Importar Cartas');

            } else {
                $productosComprados = Cart::session(auth()->id())->getContent();
    
                if ($this->GenerarProductosComprados($datosTarjeta['ordenCompra'], $productosComprados)) 
                {
                    $this->finalizarOrdenCompra($datosTarjeta['ordenCompra'], 'Pago Online con MercadoPago');
    
                    if ($this->ReducirStock($productosComprados)) 
                    {
                        Cart::session(auth()->id())->clear();
                        Cart::session(auth()->id())->clearCartConditions(); //hay que quitar el cupon de descuento
    
                        Mail::to('mr.corvy@gmail.com')->send(new MailVendedor);
    
                        return redirect()->route('home', Auth::user()->username);
                    }else {
                        return abort(500);
                    }
                }else {
                    return abort(500);
                }
            }
        }else
        {
            return abort(500);
        }

        return redirect()->route('Checkout')->withMessage('Hubo un error en la transacción. Revisá que los datos de tu tarjeta estén correctos, y que tengas fondos disponibles en la mísma. Si el error se repite, por favor contactános al WhatsApp 011 3771-9677 o al email mr.corvy@gmail.com');
    }

    public function AplicarCupon($codigoCupon)
    {
        if ($codigoCupon !== '-5%') {
            $validarCupon = Cupon::where('codigo', $codigoCupon)->first();

            $validarUsuario = CuponUser::where('codigo', $codigoCupon)->where('username', Auth::user()->username)->first();
            
            if (!$validarCupon || $validarUsuario) {
                return false;
            }

            CuponUser::create([
                'codigo' => $codigoCupon,
                'username' => Auth::user()->username,
            ]);
        
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => $validarCupon->nombre,
                'type' => $validarCupon->tipo,
                'target' => 'total', 
                'value' => $validarCupon->porcentaje,
            ));

            Cart::session(auth()->id())->condition($condition);

            return true;

        } else {
        
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'descuento en efectivo',
                'type' => 'discount',
                'target' => 'total', 
                'value' => $codigoCupon, //va a ser "5%" por que estamos pagando en efectivo
            ));

            Cart::session(auth()->id())->condition($condition);

            return true;
        }
    }

    public function CrearPeticionPagoMP($cardNetwork, $cardToken, $email, $installments)
    {   
        $requestStatus = $this->makeRequest(
            'POST',
            '/v1/payments',
            [],
            [
                'payer' => [
                    'email' => $email,
                ],
                'binary_mode' => true, //binary_mode es para pedir que la transaccion tenga solo 2 estados, aprobada o rechazada
                'transaction_amount' => ceil(Cart::session(auth()->id())->getTotal()),
                'payment_method_id' => $cardNetwork,
                'token' => $cardToken,
                'installments' => intval($installments),//la cantidad de cuotas en el pago
                'statement_descriptor' => 'Yu-Gi-Oh! Para El Pueblo',
            ],
            [],
            $isJsonRequest = true
        );

        // hay que actualizra las key y secret para q sean las mias
        // $this->key = config('APP_USR-9f9a624d-6aee-42c0-b186-0b66eaac5e2f');
        // $this->secret = config('APP_USR-7120844547621159-041414-3c4dbca63f186bbe109dc39cf1def901-143014265');

        // $this->makeRequest(
        //     'POST',
        //     '/v1/payments',
        //     [],
        //     [
        //         'payer' => [
        //             'email' => $email,
        //         ],
        //         'binary_mode' => true, //binary_mode es para pedir que la transaccion tenga solo 2 estados, aprobada o rechazada
        //         'transaction_amount' => 10,
        //         'payment_method_id' => $cardNetwork,
        //         'token' => $cardToken,
        //         'installments' => 1,//la cantidad de cuotas en el pago
        //         'statement_descriptor' => 'Transacciones MercadoPago',
        //     ],
        //     [],
        //     $isJsonRequest = true
        // );

        // despues se manda el dinero a mi cuenta, y despues se paga realmente

        // if (session()->has('precio_envio')) 
        // {
        //     session()->forget('precio_envio');
        // }

        return $requestStatus;
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['access_token'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response); //fundamental para decodificar la respoesta de mercadopago (se lo llama desde el ConsumesExternalServices)
    }

    public function resolveAccessToken()
    {
        return $this->secret; //este es el secret key de la aplicacion en mp
    }

    public function GenerarProductosComprados($idOrdenCompra, $compras)
    {
        try {
            foreach ($compras as $producto) {
                    Compra::create([
                        'id_producto' => $producto->id,
                        'producto' => $producto->name,
                        'precio_unidad' => floor($producto->price),
                        'unidades_compradas' => $producto->quantity,
                        'orden_compra' => $idOrdenCompra,
                    ]);
                }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function ReducirStock($reduciendoProductos)
    {
        try {
            foreach ($reduciendoProductos as $reducirStock) {
                $editar = Product::find($reducirStock->id);
                $editar->stock = $editar->stock - $reducirStock->quantity;
                $editar->save();
            }//reduzco el stock de todo lo que compró
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
