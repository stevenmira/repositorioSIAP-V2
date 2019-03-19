<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EstadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado')->insert([
            'nombre' => 'CANCELADO',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'ABONO',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'PENDIENTE',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'ATRASO',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'NO VALIDO',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'CANCELADO CON REF.',
        ]);
    }
}
