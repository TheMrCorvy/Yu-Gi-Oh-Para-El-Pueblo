<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TipoCartaForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(BluePrint $table){
            $table->unsignedInteger('producto');
            $table->foreign('producto')->references('id')->on('type_products');
            
            $table->unsignedInteger('carta_id')->nullable();
            $table->foreign('carta_id')->references('id')->on('type_cartas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(BluePrint $table){
            $table->dropForeign(['carta_id']);
            $table->dropColumn('carta_id');
            
            $table->dropForeign(['producto']);
            $table->dropColumn('producto');
        });
    }
}
