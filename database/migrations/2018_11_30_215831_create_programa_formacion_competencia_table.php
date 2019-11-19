<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramaFormacionCompetenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_formacion_competencia', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('programa_formacion_id');
            $table->unsignedInteger('competencia_id');
            $table->foreign('programa_formacion_id')->references('id')->on('programas_formacion')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('programa_formacion_competencia');
    }
}
