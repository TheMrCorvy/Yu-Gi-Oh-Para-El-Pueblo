<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('Landing');

Route::get('info', function() {
    return view('info');
})->name('Info');

//yugioh
Route::get('cartas/{param?}', 'ProductController@ShowCartas')->name('Cartas');
    
Route::get('ofertas/{param?}', 'ProductController@ShowOfertas')->name('Ofertas');

Route::get('productos-relacionados/{param?}', 'ProductController@ShowOtros')->name('Productos Relacionados');


//categorias
Route::get('categoria/{categoria}', 'CategoryController@ShowGeneral')->name('Categoria');
    
Route::get('categoria/{categoria}/{param?}', 'CategoryController@ShowCategoriaFiltro');

Route::get('general/{param?}', 'CategoryController@ShowOtros')->name('Productos General');


//producto
Route::get('producto/{id}', 'ProductController@FindProduct')->name('Producto');

//buscar
Route::get('buscar', 'ProductController@BuscarProducto')->name('Buscar');


//auth
Auth::routes();

//usuario
Route::middleware('auth')->group(function () {
    
    //cosas del usuario
    Route::get('editar-perfil', 'UserController@EditarPerfil')->name('Editar Perfil');

    Route::post('editar-perfil', 'UserController@EditarMiUsuario')->name('Editar Mi Usuario');
    
    Route::get('home/{username}', function(){
        return view('auth.compras');
    })->name('home');


    //carrito
    Route::get('add-to-cart/{id}', 'UserController@AddToCart')->name('Añadir Al Carrito');
    
    Route::get('remove-from-cart/{id}', 'UserController@QuitarDelCarrito')->name('Quitar Del Carrito');
    
    Route::post('update-cart/{id}', 'UserController@ActualizarCarrito')->name('Actualizar Carrito');

    //checkout
    Route::get('checkout', 'HomeController@Checkout')->name('Checkout');

    Route::post('checkout/paso-1', 'HomeController@PasoUno')->name('Paso Uno');  

    Route::post('checkout/paso-2', 'HomeController@PasoDos')->name('Paso Dos'); 

    //comprar ahora
    Route::get('comprar-aohra/{idProd}', 'HomeController@ComprarAhora')->name('Comprar Ahora');

//MERCADOPAGO
    Route::post('checkout/paso-3', 'ComprasController@PagoOnline')->name('Paso Tres');  

//PAGO EN EFECTIVO
    Route::get('pago-en-la-entrega/{orden}', 'ComprasController@PagoEfectivo')->name('Pago En La Entrega');

    Route::get('checkout/destroy/{orden}', 'HomeController@destroy')->name('Destroy Order');
});



Route::middleware(['auth',])->group(function () {
    
    //admin
    Route::get('admin', 'AdminController@index')->name('admin.index')->middleware('can:admin.index');

    //              ruta            controllador              nombre de la ruta = al permiso en el seeder
    Route::get('admin/ordenes-de-compra', 'AdminController@VisualizarCompras')->name('admin.compras')
                        // verificar con el permiso si de hecho el usuario puede o no entrar a esa ruta
                        ->middleware('can:admin.compras');
    //detalle de ventas
    Route::get('admin/detalle-venta/{username}/{ordenCompra}', 'AdminController@DetalleCompra')->name('admin.compras-detalle')->middleware('can:admin.compras-detalle');

    //agregar dinero
    Route::post('agregar-dinero/{param}', 'AdminController@AgregarDinero')->name('Agregar Dinero');


    //cupones
    Route::post('generar-cupon', 'AdminController@GenerarCupon')->name('Generar Cupon')->middleware('can:admin.create-coupon');
    
    Route::get('mostrar-cupon', 'AdminController@ShowCupon')->name('Ver Cupones')->middleware('can:admin.show-coupon');
    
    //exportar excel todas las ventas
    Route::get('admin/excel-todo', 'AdminController@ComprasExcelTodo')->name('admin.excel-ventas')->middleware('can:admin.excel-ventas');

    //exportar excel exportar productos
    Route::get('admin/excel-productos', 'ProductController@ExportarProductos')->name('admin.excel-productos')->middleware('can:admin.excel-productos');

    //importar excel importar productos
    Route::post('admin/excel-import', 'ProductController@ImportarProductos')->name('admin.excel-import')->middleware('can:admin.excel-import');


    //porductos

    //crear
    Route::post('productos/create', 'ProductController@CrearProducto')->name('products.create')->middleware('can:products.create');

    //editar
    Route::post('editar/{id}', 'ProductController@EditarProducto')->name('products.edit')->middleware('can:products.edit');

    //ver formulario para editar
    Route::get('producto/{id}/editar', 'ProductController@FormEditarProducto')->name('products.show-form')->middleware('can:products.show-form');
    
    //eliminar
    Route::post('productos/destroy/{id}', 'ProductController@DestruirProducto')->name('products.destroy')->middleware('can:products.destroy');

    //multiplicador del dolar
    Route::post('multiplicador/edit', 'MultiplicadorController@ActualizarDolar')->name('multiplicador.edit')->middleware('can:multiplicador.edit');

    
    //categorías

    //crear 
    Route::post('category/create', 'CategoryController@store')->name('admin.create-category')->middleware('can:admin.create-category');

    //editar
    Route::post('category/edit/{id}', 'CategoryController@edit')->name('admin.edit-category')->middleware('can:admin.create-category');

    //borrar
    Route::post('category/destroy/{id}', 'CategoryController@destroy')->name('admin.destroy-category')->middleware('can:admin.destroy-category');
    
    
    //tipos de productos

    //crear 
    Route::post('type-product/create', 'TypeProductController@store')->name('admin.create-type')->middleware('can:admin.create-type');

    //editar
    Route::post('type-product/edit/{id}', 'TypeProductController@edit')->name('admin.edit-type')->middleware('can:admin.create-type');

    //borrar
    Route::post('type-product/destroy/{id}', 'TypeProductController@destroy')->name('admin.destroy-type')->middleware('can:admin.destroy-type');
    
    
    //tipos de cartas

    //crear 
    Route::post('type-carta/create', 'TypeCartaController@store')->name('admin.create-type-carta')->middleware('can:admin.create-type-carta');

    //editar
    Route::post('type-carta/edit/{id}', 'TypeCartaController@edit')->name('admin.edit-type-carta')->middleware('can:admin.create-type-carta');

    //borrar
    Route::post('type-carta/destroy/{id}', 'TypeCartaController@destroy')->name('admin.destroy-type-carta')->middleware('can:admin.destroy-type-carta');

});