<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->integer('trimestre');
            $table->integer('ano');
            $table->unsignedInteger('programa_formacion_id');
            $table->unsignedInteger('municipio_id');
            $table->foreign('programa_formacion_id')->references('id')->on('programas_formacion')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('programaciones');
    }
}
