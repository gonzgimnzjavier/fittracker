<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_clase_cliente_table.php
public function up()
{
    Schema::create('clase_cliente', function (Blueprint $table) {
        $table->id();
        $table->foreignId('clase_id')->constrained()->onDelete('cascade');
        $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_cliente');
    }
};
