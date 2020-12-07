<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_compras', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            
            $table->date('fecha');
            $table->string('forma_de_pago')->nullable();
            $table->string('monto_total');

            $table->string('agregar_dinero_envio')->nullable();

            $table->string('nombre');
            $table->string('dni');
            $table->string('calle');
            $table->integer('altura');
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('codigo_postal');
            $table->boolean('finalizada');

            $table->boolean('envio');
            $table->string('metodo_envio')->nullable();
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
        Schema::dropIfExists('ordenes_compras');
    }
}
