<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaMembresias extends Migration
{
    public function up()
    {
        Schema::create('membresias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('max_clases');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('membresias');
    }
}
