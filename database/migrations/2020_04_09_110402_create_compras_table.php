<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            // $table->string('username');
            $table->string('producto');
            $table->integer('orden_compra');
            $table->integer('id_producto');
            // $table->string('mes');
            // $table->string('forma_de_pago');
            // $table->date('fecha');
            $table->integer('precio_unidad');
            $table->integer('unidades_compradas');
            // $table->string('monto_total');
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
        Schema::dropIfExists('compras');
    }
}
