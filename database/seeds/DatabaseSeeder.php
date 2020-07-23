<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(MultiplicadorSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeProductSeeder::class);
        $this->call(TypeCartaSeeder::class);
        $this->call(ProductsSeeder::class);
    }
}
