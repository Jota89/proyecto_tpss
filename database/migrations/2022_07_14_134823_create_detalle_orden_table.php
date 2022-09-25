<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable(false);
            //$table->foreign('order_id')->references('id')->on('ordenes');
            $table->integer('producto_id')->nullable(false);
            //$table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('cantidad')->nullable(false);
            $table->double('precio')->nullable(false);
            $table->double('descuento')->nullable();
            $table->integer('categoria_id')->nullable(false);
            //$table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('detalle_orden');
    }
}
