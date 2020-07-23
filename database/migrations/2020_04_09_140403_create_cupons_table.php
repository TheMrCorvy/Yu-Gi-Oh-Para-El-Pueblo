<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('porcentaje');
            $table->string('tipo');
            $table->string('nombre');
            $table->date('fecha');
            $table->timestamps();
        });
        Schema::create('cupones_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('username');
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
        Schema::dropIfExists('cupones');
        Schema::dropIfExists('cupones_usuarios');
    }
}
