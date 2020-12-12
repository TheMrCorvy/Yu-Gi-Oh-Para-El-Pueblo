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

            $table->string('username');

            $table->unsignedInteger('orden_compra')->nullable();
            $table->foreign('orden_compra')->references('id')->on('ordenes_compras')->onDelete('cascade');

            $table->string('estado');
            $table->string('comentario_al_paquete')->nullable();
            $table->date('fecha_caducidad_precio')->nullable();
            $table->string('seguimiento_envio')->nullable();
            $table->integer('pago_inicial')->nullable();
            $table->string('envio')->nullable();
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
