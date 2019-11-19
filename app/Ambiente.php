<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trimestre;

class Ambiente extends Model
{
    protected $table = 'ambientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'estado',
        'usabilidad',
    ];

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
            ->where('ambientes.id', $this->id);
    }

    public function obtenerHorarioProgramado($trimestre, $ano)
    {
        return $this->horarios()->select('ambientes.nombre as nombreAmbiente', 'horarios.fechaInicio', 'horarios.fechaFin', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'horarios.dia', 'programas_formacion.nombre as programaFormacionNombre', 'programas_formacion.numeroFicha')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->join('franjas', 'horarios.franja_id', 'franjas.id')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->join('programas_formacion', 'programaciones.programa_formacion_id', 'programas_formacion.id')
            ->join('ambientes', 'horarios.ambiente_id', 'ambientes.id')
            ->where('programaciones.trimestre', $trimestre)
            ->where('programaciones.ano', $ano)
            ->where('ambientes.id', $this->id);
    }

    /**
     * Obtener ambientes disponibles
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scopeObtenerAmbientesDisponibles($query, $ambientesRegistrados, $franja_id, $dia, $trimestre = null, $ambiente_id, $ano)
    {
        $ambientesDisponibles = $query->orderBy('nombre')
            ->whereDoesntHave('horarios', function($query) use($ambientesRegistrados, $franja_id, $dia, $trimestre, $ambiente_id, $ano) {
                $query->whereIn('horarios.ambiente_id', $ambientesRegistrados)
                    ->where('horarios.franja_id', $franja_id)
                    ->where('horarios.dia', $dia)
                    ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
                    ->where('programaciones.trimestre', $trimestre)
                    ->where('programaciones.ano', $ano)
                    ->where('ambientes.id', '!=', $ambiente_id);
            });

        return $ambientesDisponibles;
    }

    public function calcularHorasAcumuladas()
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        if(!empty($trimestres)) {
            $horasAcumuladas = $this->selectRaw('SEC_TO_TIME(SUM(TO_SECONDS(franjas.horaFin) - TO_SECONDS(franjas.horaInicio))) as horasAcumuladas')
                ->where('ambientes.id', $this->id)
                ->join('horarios', 'ambientes.id', '=', 'horarios.ambiente_id')
                ->join('franjas', 'horarios.franja_id', '=', 'franjas.id')
                ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
                ->where('programaciones.trimestre', $trimestres->trimestre)
                ->where('programaciones.ano',   $trimestres->ano)
                ->first();

            return $horasAcumuladas->horasAcumuladas;
        }
    }

}
