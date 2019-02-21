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
            'calificacion' => 'EXCELENTE',
            'descripcion' => 'Maximo 1 cuota de atraso',
        ]);

        DB::table('categoria')->insert([
            'letra' => 'B',
            'calificacion' => 'BUENO',
            'descripcion' => 'De 1 a 5 cuotas de atraso',
        ]);

        DB::table('categoria')->insert([
            'letra' => 'C',
            'calificacion' => 'REGULAR',
            'descripcion' => 'Mayor a 6 cuotas de atraso',
        ]);

        DB::table('categoria')->insert([
            'letra' => 'D',
            'calificacion' => 'MALO',
            'descripcion' => 'Mayor a 13 cuotas de atraso',
        ]);

        DB::table('categoria')->insert([
            'letra' => 'E',
            'calificacion' => 'MORA',
            'descripcion' => 'Maximo 1 cuotra de atraso',
        ]);
    }
}
