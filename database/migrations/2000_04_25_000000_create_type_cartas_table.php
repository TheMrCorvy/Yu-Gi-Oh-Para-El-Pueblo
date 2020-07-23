<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeCartasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_cartas', function (Blueprint $table) {
            $table->increments('id'); //ESTO NO SE PUEDE DEFINIR CON $table->id(); POR QUE DA UN ERROR DE QUE LA COLUMNA NO ESTÁ BIEN DEFINIDA, YA QUE ES APUNTADA POR UNA FOREIGN KEY
            $table->string('tipo_carta');
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
        Schema::dropIfExists('type_cartas');
    }
}
