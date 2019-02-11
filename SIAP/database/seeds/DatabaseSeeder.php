<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(Tipo_Credito::class);
        $this->call(Tipo_Usuario::class);
        $this->call(ReciboSeed::class);
        $this->call(CategoriaSeed::class);
        $this->call(Tipo_Desembolso::class);
    }
}
