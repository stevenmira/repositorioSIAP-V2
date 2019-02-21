<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo', function (Blueprint $table) {
            $table->increments('idprestamo');

            //Relacion Prestamo con Codeudor
            $table->integer('idcodeudor')->nullable()->unsigned();
            $table->index('idcodeudor');
            $table->foreign('idcodeudor')->references('idcodeudor')->on('codeudor')->onDelete('cascade');

            //Relacion Prestamo con TipoDesembolso
            $table->integer('idtipodesembolso')->unsigned();
            $table->index('idtipodesembolso');
            $table->foreign('idtipodesembolso')->references('idtipodesembolso')->on('tipo_desembolso')->onDelete('cascade');

            $table->date('fechacomienzo')->required();

            $table->date('fecha')->required();
             //formato tipo decimal('nombre de campo',tamaño, precision)
            $table->float('monto')->required();
            $table->float('cuotadiaria')->required();
            $table->date('fechaultimapago')->nullable();
            $table->string('estado',20)->required();
            $table->float('montooriginal')->nullable();
            $table->string('estadodos',20)->nullable();
            $table->integer('cuentaanterior')->nullable();
            $table->string('numerocheque',50)->nullable();

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
        Schema::drop('prestamo');
    }
}
