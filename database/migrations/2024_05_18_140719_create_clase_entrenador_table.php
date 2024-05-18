<?php

// database/migrations/2024_05_18_140719_create_clase_entrenador_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaseEntrenadorTable extends Migration
{
    public function up()
    {
        Schema::create('clase_entrenador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clase_id')->constrained('clases')->onDelete('cascade');
            $table->foreignId('entrenador_id')->constrained('entrenadores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clase_entrenador');
    }
}
