<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZimprevistosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imprevistos', function (Blueprint $table) {
            $table->id();
            $table->string('patente');
            $table->foreignId('chofer_id')->constrained('choferes');
            $table->foreignId('viaje_id')->constrained('viajes');
            $table->dateTime('fecha');
            $table->string('comentario');
            $table->string('resuelto');
            $table->softDeletes();
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
        Schema::dropIfExists('imprevistos');
    }
}