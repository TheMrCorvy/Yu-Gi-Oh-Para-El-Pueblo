<?php

use Illuminate\Database\Seeder;

class EnviosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metodos_de_envio')->insert([
            'metodo' => 'Moto Mensajería',
            'tiempo_previsto' => '24 horas hábiles',
        ]);
        DB::table('metodos_de_envio')->insert([
            'metodo' => 'Correo Argentino',
            'tiempo_previsto' => '3 a 5 días hábiles',
        ]);
        
        DB::table('zonas_de_envio')->insert([
            'metodo_envio' => 2,
            'zona' => 'Interior a Domicilio',
            'precio' => '450',
        ]);
        DB::table('zonas_de_envio')->insert([
            'metodo_envio' => 2,
            'zona' => 'Interior a Sucursal de Correo',
            'precio' => '400',
        ]);
        DB::table('zonas_de_envio')->insert([
            'metodo_envio' => 2,
            'zona' => 'Provincia a Domicilio',
            'precio' => '350',
        ]);
        DB::table('zonas_de_envio')->insert([
            'metodo_envio' => 2,
            'zona' => 'Provincia a Sucursal de Correo',
            'precio' => '300',
        ]);
        DB::table('zonas_de_envio')->insert([
            'metodo_envio' => 1,
            'zona' => 'Capital Federal',
            'precio' => '300',
        ]);
    }
}
