<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonasDeEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonas_de_envio', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('metodo_envio');
            $table->foreign('metodo_envio')->references('id')->on('metodos_de_envio')->onDelete('cascade');

            $table->string('zona');
            $table->integer('precio');
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
        Schema::dropIfExists('zonas_de_envio');
    }
}
