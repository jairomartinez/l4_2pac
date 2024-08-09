<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->string('nombre');
            $table->unsignedInteger('proveedor_id');
            $table->timestamps();
        });

        /**
         * Agregar la tabla pivote de la relacion
         * entre categorias y productos
         */
        Schema::create('categoria_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("categoria_id");
            $table->unsignedBigInteger("producto_id");
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function ódown(): void
    {
        Schema::dropIfExists('productos');
        Schema::dropIfExists('categoria_producto');
    }
};
