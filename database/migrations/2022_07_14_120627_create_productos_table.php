<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->nullable(false);
            $table->string('nombre', 200)->nullable(false);
            $table->text('descripcion')->nullable();
            $table->double('precio')->nullable(false);
            $table->double('descuento')->nullable(true);
            $table->integer('categoria_id')->nullable(false);
           // $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('proveedor_id')->nullable(false);
            //$table->foreign('proveedor_id')->references('id')->on('usuarios');
            $table->integer('stock')->nullable(false);
            $table->text('imagen')->nullable();
            $table->text('galeria')->nullable();
            $table->integer('estado')->nullable(false); // 1: activo -  0: inactivo
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
        Schema::dropIfExists('productos');
    }
}
