<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarteraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartera', function (Blueprint $table) {
            $table->increments('idcartera');

            // Relacion Cartera con Ejecutivo
            $table->integer('idejecutivo')->unsigned();
            $table->index('idejecutivo');
            $table->foreign('idejecutivo')->references('idejecutivo')->on('ejecutivo')->onDelete('cascade');

            // Relacion Cartera con Supervisor
            $table->integer('idsupervisor')->unsigned();
            $table->index('idsupervisor');
            $table->foreign('idsupervisor')->references('idsupervisor')->on('supervisor')->onDelete('cascade');

            $table->string('nombre',50)->required();
            $table->string('estado',10)->required();

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
        Schema::drop('cartera');
    }
}
