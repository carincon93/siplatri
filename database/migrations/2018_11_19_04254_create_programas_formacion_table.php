<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramasFormacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas_formacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->bigInteger('numeroFicha')->unique();
            $table->string('tipoFormacion');
            $table->string('duracion');
            $table->string('modalidad');
            $table->integer('cantidadAprendices');
            $table->date('fechaInicioLectiva');
            $table->date('fechaFinLectiva')->nullable();
            $table->date('fechaFinPrograma');
            $table->unsignedInteger('gestor_id');
            $table->foreign('gestor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('programas_formacion');
    }
}
