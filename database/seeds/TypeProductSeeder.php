<?php

use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_products')->insert([
            'tipo_producto' => 'Carta de Yu-Gi-Oh!',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Sobres Sellados Yu-Gi-Oh!',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Tin de Yu-Gi-Oh!',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Boosterbox de Yu-Gi-Oh!',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Deckbox (Portadeck)',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Folios Para Cartas Coleccionables',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Playmat / Manta',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Core de Yu-Gi-Oh!',
        ]); 
        DB::table('type_products')->insert([
            'tipo_producto' => 'Mazo Estructura de Yu-Gi-Oh!',
        ]); 
    }
}
