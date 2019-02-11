<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Tipo_Credito extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_credito')->insert([
            'nombre' => 'Normal',
            'condicion' => 'Menor o Igual a',
            'monto' => 80,
            'interes' => 0.017,
            'estado' => 'DISPONIBLE',
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'Normal',
            'condicion' => 'Mayor a $80 y Menor o Igual a',
            'monto' => 105,
            'interes' => 0.011,
            'estado' => 'DISPONIBLE',
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'Normal ',
            'condicion' => 'Mayor a',
            'monto' => 105,
            'interes' => 0.010,
            'estado' => 'DISPONIBLE',
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'Preferencial',
            'condicion' => 'No Aplica',
            'monto' => 0,
            'interes' => 0.008,
            'estado' => 'DISPONIBLE',
        ]);

        DB::table('tipo_credito')->insert([
            'nombre' => 'Oro',
            'condicion' => 'No Aplica',
            'monto' => 0,
            'interes' => 0.007,
            'estado' => 'DISPONIBLE',
        ]);
    }
}
