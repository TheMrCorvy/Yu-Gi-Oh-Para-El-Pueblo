<?php

use Illuminate\Database\Seeder;

class MultiplicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('multiplicador')->insert([
            'multiplicador' => 75,
        ]); 
    }
}
