<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //rol admin
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access',
        ]);   
        
        //usuarios autorizados
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);   
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 2,
        ]);   
        
        //permisos de productos
        DB::table('permissions')->insert([
            'name' => 'creacion de productos',
            'slug' => 'products.create',
            'description' => 'crear un producto en el sistema',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'edicion de productos',
            'slug' => 'products.edit',
            'description' => 'editar un producto del sistema',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'eliminacion de productos',
            'slug' => 'products.destroy',
            'description' => 'eliminar un producto del sistema',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'form aditar',
            'slug' => 'products.show-form',
            'description' => 'acceder al formulario para editar algo',
        ]);   
        
        //permisos de dolar
        DB::table('permissions')->insert([
            'name' => 'modificar dolar',
            'slug' => 'multiplicador.edit',
            'description' => 'modificar el multiplicador en función del dolar',
        ]);

        //admin
        DB::table('permissions')->insert([
            'name' => 'accedeer a la seccion admin',
            'slug' => 'admin.index',
            'description' => 'accedeer a la seccion admin',
        ]);     

        //excel
        DB::table('permissions')->insert([
            'name' => 'crear excel compras del mes',
            'slug' => 'admin.excel-ventas-mes',
            'description' => 'crear excel con las compras del mes',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'crear excel todas las compras',
            'slug' => 'admin.excel-ventas',
            'description' => 'crear excel con todo el historial de ventas',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'crear excel productos',
            'slug' => 'admin.excel-productos',
            'description' => 'crear excel con todos los productos',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'importar excel productos',
            'slug' => 'admin.excel-import',
            'description' => 'importar en la base de datos desde excel',
        ]);   
        
        //permisos para ver ventas
        DB::table('permissions')->insert([
            'name' => 'ventas',
            'slug' => 'admin.compras',
            'description' => 'entrar a a la seccion de ordenes de compra',
        ]);   
        DB::table('permissions')->insert([
            'name' => 'detalle ventas',
            'slug' => 'admin.compras-detalle',
            'description' => 'ver detalle de compra por fecha y usuario',
        ]);   

        //cupones
        DB::table('permissions')->insert([
            'name' => 'crear cupon',
            'slug' => 'admin.create-coupon',
            'description' => 'permiso para crear cupones de descuento',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'ver cupon',
            'slug' => 'admin.show-coupon',
            'description' => 'permiso para acceder a los cupones de descuento',
        ]); 

        //categoria
        DB::table('permissions')->insert([
            'name' => 'crear categoria',
            'slug' => 'admin.create-category',
            'description' => 'permiso para crear nuevas categorias',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'editar categoria',
            'slug' => 'admin.edit-category',
            'description' => 'permiso para editar categorias',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'borrar categoria',
            'slug' => 'admin.destroy-category',
            'description' => 'permiso para borrar categorias',
        ]); 
        
        //tipo producto
        DB::table('permissions')->insert([
            'name' => 'crear tipo producto',
            'slug' => 'admin.create-type',
            'description' => 'permiso para crear nuevos tipos de productos',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'editar tipo producto',
            'slug' => 'admin.edit-type',
            'description' => 'permiso para editar tipos de productos',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'borrar tipo producto',
            'slug' => 'admin.destroy-type',
            'description' => 'permiso para borrar tipos de productos',
        ]); 
        
        //tipo de carta
        DB::table('permissions')->insert([
            'name' => 'crear tipo carta',
            'slug' => 'admin.create-type-carta',
            'description' => 'permiso para crear nuevos tipos de cartas',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'editar tipo carta',
            'slug' => 'admin.edit-type-carta',
            'description' => 'permiso para editar tipos de cartas',
        ]); 
        DB::table('permissions')->insert([
            'name' => 'borrar tipo carta',
            'slug' => 'admin.destroy-type-carta',
            'description' => 'permiso para borrar tipos de cartas',
        ]); 

        //pedidos de importacion
        DB::table('permissions')->insert([
            'name' => 'ver lista pedidos',
            'slug' => 'admin.list-pakages',
            'description' => 'permiso para ver la lista de pedidos del exterior',
        ]); 
        
        DB::table('permissions')->insert([
            'name' => 'revisar pedido',
            'slug' => 'admin.review-pakage',
            'description' => 'permiso para modificar cantidades de cartas, precios, y comentarios',
        ]); 
        
    }
}
