<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trimestre;

class Programacion extends Model
{
    protected $table = 'programaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'trimestre',
        'ano',
        'trimestre_ano_id',
        'programa_formacion_id',
        'municipio_id',
    ];

    public function programaFormacion()
    {
        return $this->belongsTo('App\ProgramaFormacion');
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }

    public function horario()
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        return $this->horarios()->select('ambientes.nombre as nombreAmbiente', 'horarios.fechaInicio', 'horarios.fechaFin', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'horarios.dia', 'programas_formacion.nombre as programaFormacionNombre', 'programas_formacion.numeroFicha')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->join('franjas', 'horarios.franja_id', 'franjas.id')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->join('programas_formacion', 'programaciones.programa_formacion_id', 'programas_formacion.id')
            ->join('ambientes', 'horarios.ambiente_id', 'ambientes.id')
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null)
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.id', $this->id);
    }

    public function calcularHorasProgramadas()
    {
        $horasProgramadas = $this->selectRaw('SEC_TO_TIME(SUM(TO_SECONDS(franjas.horaFin) - TO_SECONDS(franjas.horaInicio))) as horasProgramadas')
            ->join('horarios', 'programaciones.id', '=', 'horarios.programacion_id')
            ->join('franjas', 'horarios.franja_id', '=', 'franjas.id')
            ->where('programaciones.id', $this->id)
            ->first();

        return $horasProgramadas->horasProgramadas;
    }

    public function obtenerHorario($dia, $franja_id)
    {
        $horario = $this->horarios()->select('horarios.ambiente_id', 'horarios.competencia_id', 'horarios.resultado_aprendizaje_id', 'horarios.instructor_id', 'horarios.fechaInicio', 'horarios.fechaFin', 'ambientes.nombre as nombreAmbiente', 'users.nombre as nombreInstructor')
            ->join('ambientes', 'horarios.ambiente_id', '=', 'ambientes.id')
            ->join('users', 'horarios.instructor_id', '=', 'users.id')
            ->where('horarios.dia', $dia)
            ->where('horarios.franja_id', $franja_id)
            ->first();

        return $horario;
    }

    /**
    * Obtener ambientes asignados
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function obtenerAsignaciones($programacionId)
    {
        $asignaciones = $this->select('ambientes.id as ambienteId', 'ambientes.nombre as nombreAmbiente', 'horarios.dia', 'horarios.fechaInicio', 'horarios.fechaFin', 'horarios.id', 'horarios.programacion_id', 'users.id as instructorId', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'competencias.resumen')
            ->where('programaciones.id', $programacionId)
            ->join('horarios', 'programaciones.id', '=', 'horarios.programacion_id')
            ->join('ambientes', 'horarios.ambiente_id', '=', 'ambientes.id')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->join('competencias', 'horarios.competencia_id', 'competencias.id')
            ->orderBy('horarios.fechaFin', 'ASC')
            ->get();
        return $asignaciones;
    }
}
