<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosAprendizajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados_aprendizaje', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('descripcion');
            $table->unsignedInteger('competencia_id');
            $table->integer('horas');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('resultados_aprendizaje');
    }
}
