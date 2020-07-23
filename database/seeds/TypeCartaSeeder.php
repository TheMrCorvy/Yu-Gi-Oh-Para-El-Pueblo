<?php

use Illuminate\Database\Seeder;

class TypeCartaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_cartas')->insert([
            'tipo_carta' => 'Carta de Trampa',
        ]);
        DB::table('type_cartas')->insert([
            'tipo_carta' => 'Carta Mágica',
        ]);
        DB::table('type_cartas')->insert([
            'tipo_carta' => 'Carta de Monstruo',
        ]);
        DB::table('type_cartas')->insert([
            'tipo_carta' => 'Token',
        ]);
        DB::table('type_cartas')->insert([
            'tipo_carta' => 'Field Center (Centro de Campo)',
        ]);
    }
}
