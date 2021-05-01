<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combis', function (Blueprint $table) {
            $table->id();
            $table->string('patente');
            $table->string('modelo');
            $table->integer('cantidad_asientos');
            $table->string('tipo');
            $table->foreignId('chofer_id')->constrained('choferes');
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
        Schema::dropIfExists('combis');
    }
}
