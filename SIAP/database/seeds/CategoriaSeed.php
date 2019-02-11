<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert([
            'letra' => 'A',
            'descripcion' => 'Es menor a x cuota',
            'estado' => 'APROBADO',
        ]);

        DB::table('categoria')->insert([
            'letra' => 'E',
            'descripcion' => 'Es mayor a y cuota',
            'estado' => 'REPROBADO',
        ]);
    }
}
