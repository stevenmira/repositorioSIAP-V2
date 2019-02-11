<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Tipo_Desembolso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_desembolso')->insert([
            'nombre' => 'EFECTIVO',
            'estado' => 'ACTIVO',
        ]);

        DB::table('tipo_desembolso')->insert([
            'nombre' => 'CHEQUE',
            'estado' => 'ACTIVO',
        ]);
    }
}
