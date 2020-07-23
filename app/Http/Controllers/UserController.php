<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;
use App\Cupon;
use App\CuponUser;
use App\Multiplicador;

use Auth;

use Cart;

class UserController extends Controller
{
    public function Carrito()
    {
        if (null !== auth()->id()) {
            $productosEnCarrito = Cart::session(auth()->id())->getContent();
        }else{
            $productosEnCarrito = '';
        }

        return view('carrito', compact('productosEnCarrito'));
    }

    public function AddToCart($id) 
    {
        $producto = Product::where('id', '=', $id)
                            ->where('stock', '>=', 1)
                            ->first();

        $multiplicador = Multiplicador::orderBy('id', 'DESC')->select('multiplicador')->first();

        if (Cart::session(auth()->id())->get($producto->id)) {
            return redirect()->back();
        }//hay que verificar si el producto a añadir está de hecho en el carrito, esto para evitar que se compre más de lo q se tiene stock

        if ($producto->oferta > 0 && $producto->fecha_oferta >= date('Y-m-d')) {
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

        return redirect()->back();
    }

    public function ActualizarCarrito($id)
    {
        $actualizar = 'Actualizar' . $id; //el nombre del input

        $stockDisponible = Product::select('stock')->where('id', $id)->first();

        // if (empty($stockDisponible) || $stockDisponible == 0) 
        // { // esto es para la parte de los pedidos, si no encuentra ningun producto, o si el stock de un producto es igual a 0, le va a dejar al usuario hacer lo q quiera, total es un pedido para importación
        //     Cart::session(auth()->id())->update($id,[
        //         'quantity' => array(
        //             'relative' => false,
        //             'value' => request($actualizar)
        //         )
        //     ]);

        //     return back();
        // }

        $validar = request()->validate([
            $actualizar => 'required|integer|min:1'
        ]);

        if (request($actualizar) <= $stockDisponible->stock) {
            
            Cart::session(auth()->id())->update($id,[
                'quantity' => array(
                    'relative' => false,
                    'value' => request($actualizar)
                )
            ]);
        }else {
            Cart::session(auth()->id())->update($id,[
                'quantity' => array(
                    'relative' => false,
                    'value' => $stockDisponible->stock
                )
            ]);
        }
        return back();
    }

    public function QuitarDelCarrito($id)
    {
        Cart::session(auth()->id())->remove($id);

        return redirect()->back();
    }
    
    public function EditarPerfil()
    {
        $username = Auth::user()->username;
        
        $usuario = User::where('username', '=', $username)->first();

        return view('auth.editar-perfil', compact('usuario'));
    }

    public function EditarMiUsuario(){

        $username = Auth::user()->username;
        
        $usuario = User::where('username', '=', $username)->first();

        $message = [
            'min' => 'El valor ingresado es menor al esperado.',
            'max' => 'El valor ingresado es demasiado grande, trata de resumirlo.',
            'required' => 'Faltó completar este campo.',
            'email' => 'Parece que no ingresaste una dirección de Email válida.',
            'string' => 'El tipo de valor esperado es distinto al enviado.',
            'integer' => 'Solo se permiten números.',
        ];

        $editar = request()->validate([
            'nombreUsuario' => 'required|string|min:5|max:35',
            'emailUsuario' => 'required|email|min:6',
            'apodoUsuario' => 'required|string|min:5|max:15',
            'numeroUsuario' => 'required|string|min:8|max:14',
            'calle1Usuario' => 'nullable|string|min:3|max:75',
            'calle2Usuario' => 'nullable|string|min:3|max:25',
            'alturaUsuario' => 'required|integer',
            'barrioUsuario' => 'nullable|string|min:3|max:25',
            'provinciaUsuario' => 'required|string|min:3|max:15',
            'ciudadUsuario' => 'required|min:3|max:25|string'
        ], $message);

        $usuario->name = $editar['nombreUsuario'];    
        $usuario->email = $editar['emailUsuario'];    
        $usuario->username = $editar['apodoUsuario'];    
        $usuario->num_telefono = $editar['numeroUsuario'];    
        $usuario->calle1_timbre = $editar['calle1Usuario'];    
        $usuario->calle2 = $editar['calle2Usuario'];    
        $usuario->altura_domicilio = $editar['alturaUsuario'];    
        $usuario->barrio = $editar['barrioUsuario'];    
        $usuario->localidad = $editar['provinciaUsuario'];    
        $usuario->ciudad = $editar['ciudadUsuario'];    

        $usuario->save();

        return redirect(route('home', Auth::user()->username));
    }
}
