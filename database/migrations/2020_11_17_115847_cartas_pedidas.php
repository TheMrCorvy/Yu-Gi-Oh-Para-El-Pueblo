<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartasPedidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartas_pedidas', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('paquete');
            $table->foreign('paquete')->references('id')->on('paquetes');

            $table->string('nombre_carta');
            $table->string('expansion')->nullable();
            $table->string('comentario')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('cantidad');
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
        Schema::dropIfExists('cartas_pedidas');
    }
}
