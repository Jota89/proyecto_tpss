<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable(false);
            $table->integer('cliente_id')->nullable(false);
            //$table->foreign('cliente_id')->references('id')->on('users');
            $table->integer('metodo_pago')->nullable(false);
            $table->double('impuestos')->nullable(false);
            $table->double('subtotal')->nullable(false);
            $table->double('descuento')->nullable();
            $table->double('total')->nullable(false);
            $table->integer('empleado_id')->nullable();
            //$table->foreign('empleado_id')->references('id')->on('users');
            $table->integer('detalle_id')->nullable(false);
            //$table->foreign('detalle_id')->references('id')->on('detalle_orden');
            $table->integer('estado_id')->nullable(false);
            //$table->foreign('estado_id')->references('id')->on('estados_ordenes');
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
        Schema::dropIfExists('ordenes');
    }
}
