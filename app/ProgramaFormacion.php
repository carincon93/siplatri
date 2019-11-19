<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Programacion;
use App\Trimestre;

class ProgramaFormacion extends Model
{
    protected $table = 'programas_formacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'numeroFicha',
        'tipoFormacion',
        'duracion',
        'modalidad',
        'cantidadAprendices',
        'fechaInicioLectiva',
        'fechaFinLectiva',
        'fechaFinPrograma',
        'gestor_id',
    ];

    public function gestor()
    {
        return $this->belongsTo('App\User');
    }

    public function competencias()
    {
        return $this->belongsToMany('App\Competencia', 'programa_formacion_competencia', 'programa_formacion_id', 'competencia_id');
    }

    public function programaciones()
    {
        return $this->hasMany('App\Programacion');
    }

    public function horario()
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        return Horario::select('horarios.fechaInicio', 'horarios.fechaFin', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'horarios.dia', 'ambientes.nombre as nombreAmbiente', 'programas_formacion.nombre as programaFormacionNombre', 'programas_formacion.numeroFicha')
            ->join('franjas', 'horarios.franja_id', 'franjas.id', 'users.nombre')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->join('ambientes', 'horarios.ambiente_id', 'ambientes.id')
            ->join('programas_formacion', 'programaciones.programa_formacion_id', 'programas_formacion.id')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null)
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.programa_formacion_id', $this->id);
    }

    /**
     * Obtener programas de formación disponibles
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scopeObtenerProgramasFormacionDisponibles($query, $programa_formacion_id = null)
    {
        $programasFormacionRegistrados  = Programacion::select('programaciones.programa_formacion_id');
        $trimestres                     = Trimestre::where('programando', true)->firstOrFail();

        $programasFormacion = $query->orderBy('nombre')
            ->whereDoesntHave('programaciones', function($query) use($programasFormacionRegistrados, $trimestres, $programa_formacion_id) {
                $query->whereIn('programaciones.programa_formacion_id', $programasFormacionRegistrados)
                ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
                    ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
                    ->where('programas_formacion.id', '!=', $programa_formacion_id);
            });

        return $programasFormacion;
    }

    public function scopeSumaAprendices($query)
    {
        $sumaAprendices = $query->selectRaw('SUM(cantidadAprendices) as total');

        return $sumaAprendices;
    }
}
