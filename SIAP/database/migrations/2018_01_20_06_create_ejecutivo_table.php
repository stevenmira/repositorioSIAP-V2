<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjecutivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejecutivo', function (Blueprint $table) {
            $table->increments('idejecutivo');

            $table->string('nombre',30)->required();
            $table->string('apellido',30)->required();
            $table->string('dui',10)->nullable();
            $table->string('telefono',9)->nullable();
            $table->string('comentario',1024)->nullable();
            $table->string('correo',100)->nullable();
            $table->string('direccion',255)->nullable();
            $table->string('fotografia',1024)->nullable();
            $table->date('fechanacimiento')->nullable();
            $table->string('sexo',10)->nullable();
            $table->string('estado',10)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ejecutivo');
    }
}
