<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origen_id')->constrained('lugares');
            $table->foreignId('destino_id')->constrained('lugares');
            $table->string('descripcion');
            $table->double('distancia_km');
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
        Schema::dropIfExists('rutas');
    }
}
