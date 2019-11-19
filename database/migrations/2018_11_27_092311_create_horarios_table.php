<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->unsignedInteger('franja_id');
            $table->unsignedInteger('competencia_id');
            $table->unsignedInteger('resultado_aprendizaje_id');
            $table->unsignedInteger('ambiente_id');
            $table->unsignedInteger('programacion_id');
            $table->unsignedInteger('instructor_id');
            $table->foreign('franja_id')->references('id')->on('franjas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('competencia_id')->references('id')->on('competencias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('resultado_aprendizaje_id')->references('id')->on('resultados_aprendizaje')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ambiente_id')->references('id')->on('ambientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programacion_id')->references('id')->on('programaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('horarios');
    }
}
