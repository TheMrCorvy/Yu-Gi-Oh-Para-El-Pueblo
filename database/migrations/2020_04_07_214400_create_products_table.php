<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            // $table->string('producto');
            $table->integer('categoria');
            $table->integer('stock');
            $table->string('precio');
            $table->string('estado')->nullable();
            $table->string('idioma')->nullable();
            // https://www.youtube.com/watch?v=8R5fYk5AsgQ&t=153s claves foraneas de styde
            //acá va el tipo de carta en la otra migracion
            $table->string('rareza')->nullable();
            $table->string('expansion')->nullable();
            $table->string('marca')->nullable();
            $table->integer('cantidad_incluida')->nullable();
            $table->string('color')->nullable();
            $table->string('capacidad')->nullable();
            $table->string('size')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('oferta')->nullable();
            $table->date('fecha_oferta')->nullable();
            $table->string('link_img', 255);
            $table->string('ubicacion_archivo_imagen')->nullable();
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
        Schema::dropIfExists('products');
    }
}
