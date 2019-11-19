<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Trimestre;

class Horario extends Model
{
    protected $table = 'horarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dia',
        'horaInicio',
        'horaFin',
        'fechaInicio',
        'fechaFin',
        'franja_id',
        'competencia_id',
        'resultado_aprendizaje_id',
        'ambiente_id',
        'programacion_id',
        'instructor_id',
    ];

    public function franja()
    {
        return $this->belongsTo('App\Franja');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }

    public function resultado_aprendizaje()
    {
        return $this->belongsTo('App\ResultadoAprendizaje');
    }

    public function ambiente()
    {
        return $this->belongsTo('App\Ambiente');
    }

    public function programacion()
    {
        return $this->belongsTo('App\Programacion');
    }

    public function instructor()
    {
        return $this->belongsTo('App\User');
    }


    public function scopeFranjas($query, $horaInicio, $horaFin)
    {
        if ($horaInicio && $horaFin) {
            $franjas = $query->where('franja_id', '>=', $horaInicio)->where('franja_id', '<=', $horaFin);
            return $franjas;
        }
    }

    public function scopeDia($query, $dia)
    {
        if ($dia) {
            $horarioDia = $query->where('dia', $dia);
            return $horarioDia;
        }
    }

    public function scopeTrimestre($query, $trimestre)
    {
        if ($trimestre) {
            $horarioTrimestre = $query->where('programaciones.trimestre', $trimestre);
            return $horarioTrimestre;
        }
    }

    public function scopeAno($query, $ano)
    {
        if ($ano) {
            $horarioAno = $query->where('programaciones.ano', $ano);
            return $horarioAno;
        }
    }

    public function scopeInstructor($query, $instructorId)
    {
        if ($instructorId) {
            $horarioInstructor = $query->where('instructor_id', $instructorId);
            return $horarioInstructor;
        }
    }

    public function scopeAmbiente($query, $ambienteId)
    {
        if ($ambienteId) {
            $horarioAmbiente = $query->where('ambiente_id', $ambienteId);
            return $horarioAmbiente;
        }
    }

    public function scopeProgramaFormacion($query, $programaFormacionId)
    {
        if ($programaFormacionId) {
            $horarioProgramaFormacion = $query->where('programaciones.programa_formacion_id', $programaFormacionId);
            return $horarioProgramaFormacion;
        }
    }

    public function scopeValidacionAmbiente($query, $programacion_id, $franja_id, $dia, $ambiente_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.ambiente_id', $ambiente_id)
            ->where('horarios.dia', $dia)
            ->where('programaciones.id', '!=', $programacion_id)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeValidacionInstructor($query, $programacion_id, $franja_id, $dia, $instructor_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.instructor_id', $instructor_id)
            ->where('horarios.dia', $dia)
            ->where('programaciones.id', '!=', $programacion_id)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeValidacionConProgramacionActual($query, $franja_id, $ambiente_id, $dia, $instructor_id, $programacion_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
            ->where('horarios.programacion_id', $programacion_id)
            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeValidacionCompetenciaEnEsperaProgramacion($query, $fechaInicio, $fechaFin, $franja_id, $dia, $programacion_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')

            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.id', $programacion_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.id', $programacion_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.id', $programacion_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('programaciones.id', $programacion_id)

            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeValidacionCompetenciaEnEsperaAmbiente($query, $fechaInicio, $fechaFin, $franja_id, $dia, $ambiente_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')

            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.ambiente_id', $ambiente_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.ambiente_id', $ambiente_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.ambiente_id', $ambiente_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.ambiente_id', $ambiente_id)

            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeValidacionCompetenciaEnEsperaInstructor($query, $fechaInicio, $fechaFin, $franja_id, $dia, $instructor_id) : bool
    {
        $trimestres = Trimestre::where('programando', true)->firstOrFail();

        $validacion = $query->selectRaw('COUNT(*) as total')
            ->from('horarios')
            ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')

            ->where('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin)
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.instructor_id', $instructor_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.instructor_id', $instructor_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '<=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '>=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.instructor_id', $instructor_id)

            ->orWhere('horarios.franja_id', $franja_id)
            ->where('horarios.dia', $dia)
            ->where('horarios.fechaInicio', '>=', $fechaInicio)
            ->where('horarios.fechaFin', '>=', $fechaInicio)
            ->where('horarios.fechaInicio', '<=', $fechaFin )
            ->where('horarios.fechaFin', '<=', $fechaFin )
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null )
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.instructor_id', $instructor_id)

            ->first();

        if ($validacion->total == 0) {
            return true;
        } else {
            return false;
        }
    }
}
