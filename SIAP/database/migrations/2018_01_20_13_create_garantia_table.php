<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarantiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantia', function (Blueprint $table) {
            $table->increments('idgarantia');

            //Relacion Prestamo con TipoDesembolso
            $table->integer('idprestamo')->unsigned();
            $table->index('idprestamo');
            $table->foreign('idprestamo')->references('idprestamo')->on('prestamo')->onDelete('cascade');

            $table->string('descripcion',255)->required();
            $table->string('marca',50)->nullable();
            $table->string('serie',50)->nullable();
            $table->string('otros',255)->nullable();
            $table->float('valor')->nullable();
            $table->string('tipogarante',10)->nullable();

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
        Schema::drop('garantia');
    }
}
