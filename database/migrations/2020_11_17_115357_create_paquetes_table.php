<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->string('estado');
            $table->string('comentario_al_paquete')->nullable();
            $table->integer('pago_inicial');
            $table->date('fecha_caducidad_precio')->nullable();
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
        Schema::dropIfExists('paquetes');
    }
}
