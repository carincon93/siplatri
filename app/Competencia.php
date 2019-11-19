<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trimestre;

class Competencia extends Model
{
    protected $table = 'competencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'descripcion',
        'resumen',
        'duracionHoras',
    ];

    public function programasFormacion()
    {
        return $this->belongsToMany('App\ProgramaFormacion', 'programa_formacion_competencia', 'competencia_id', 'programa_formacion_id');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }

    public function resultadosAprendizaje()
    {
        return $this->hasMany('App\ResultadoAprendizaje');
    }

    public function calcularHorasAcumuladas()
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        if(!empty($trimestres)) {
            $horasAcumuladas = $this->selectRaw('SEC_TO_TIME(SUM(TO_SECONDS(franjas.horaFin) - TO_SECONDS(franjas.horaInicio))) as horasAcumuladas')
                ->where('competencias.id', $this->id)
                ->join('horarios', 'competencias.id', '=', 'horarios.competencia_id')
                ->join('franjas', 'horarios.franja_id', '=', 'franjas.id')
                ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
                ->where('programaciones.trimestre', $trimestres->trimestre)
                ->where('programaciones.ano',   $trimestres->ano)
                ->first();

            return $horasAcumuladas->horasAcumuladas;
        }
    }
}
