<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuarios autorizados
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Gonzalo Salvador Corvalán',
            'email' => 'mr.corvy@gmail.com',
            'username' => 'TheMrCorvy32',
            'password' => '$2y$10$HZ3OndeIFb5jdnlri1FLG.vCFxysFQlv2M4BZBhd8zrp5YmUY2bHi', //Peni1234
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Yifei Zhu',
            'email' => 'fernandozhu@hotmail.com',
            'username' => 'Yifei Zhu',
            'password' => '$2y$10$PSwF8OVukiiyykKBBljQqe2Teeo1.NbmKoR0pTkL2v5E5y4ifVyCW', //holachau123
        ]);
    }
}
