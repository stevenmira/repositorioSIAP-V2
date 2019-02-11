<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion', function (Blueprint $table) {
            $table->increments('idobservacion');

            //Relacion Observacion con Cliente
            $table->integer('idcliente')->unsigned();
            $table->index('idcliente');
            $table->foreign('idcliente')->references('idcliente')->on('cliente')->onDelete('cascade');

            //Relacion Observacion con Empleado
            $table->integer('idempleado')->unsigned();
            $table->index('idempleado');
            $table->foreign('idempleado')->references('idempleado')->on('empleado')->onDelete('cascade');

            $table->date('fecha')->required();
            $table->string('comentario',1024)->required();

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
        Schema::drop('observacion');
    }
}
