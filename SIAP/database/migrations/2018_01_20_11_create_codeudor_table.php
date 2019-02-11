<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeudorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codeudor', function (Blueprint $table) {
            $table->increments('idcodeudor');

            //Relacion Codeudor con Cliente
            $table->integer('idcliente')->unsigned();
            $table->index('idcliente');
            $table->foreign('idcliente')->references('idcliente')->on('cliente')->onDelete('cascade');

            $table->string('codigo',10)->required();
            $table->string('nombre',50)->required();
            $table->string('apellido',50)->required();
            $table->string('dui',10)->required();
            $table->string('nit',17)->required();
            $table->date('fechanacimiento')->required();
            $table->string('direccion',255)->required();
            $table->string('telefonocel',9)->nullable();
            $table->string('telefonofijo',9)->nullable();
            $table->string('profesion',50)->nullable();
            $table->string('domicilio',50)->required();
            $table->string('lugarexpedicion',50)->required();
            $table->date('fechaexpedicion')->required();

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
        Schema::drop('codeudor');
    }
}
