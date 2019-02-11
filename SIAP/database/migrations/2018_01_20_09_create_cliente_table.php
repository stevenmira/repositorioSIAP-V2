<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('idcliente');

            //Relacion Cliente con Cartera
            $table->integer('idcartera')->unsigned();
            $table->index('idcartera');
            $table->foreign('idcartera')->references('idcartera')->on('cartera')->onDelete('cascade');

            //Relacion Cliente con Categoria
            $table->integer('idcategoria')->unsigned();
            $table->index('idcategoria');
            $table->foreign('idcategoria')->references('idcategoria')->on('categoria')->onDelete('cascade');

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
        Schema::drop('cliente');
    }
}
