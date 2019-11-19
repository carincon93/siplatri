<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Trimestre;
use App\Horario;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'numeroDocumento',
        'celular',
        'genero',
        'rol',
        'tipoContrato',
        'estado',
        'horasAcumuladas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function programasFormacion()
    {
        return $this->hasMany('App\ProgramaFormacion', 'gestor_id');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario', 'instructor_id');
    }

    public function zonas()
    {
        return $this->belongsToMany('App\Zona', 'instructor_zona', 'user_id', 'zona_id');
    }

    public function actividades()
    {
        return $this->hasMany('App\OtraActividad');
    }

    public function hasAccess() : bool
    {
        if ($this->rol == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function hasRole()
    {
        return $this->rol;
    }

    /**
     * Obtener instructores disponibles
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scopeObtenerInstructoresDisponibles($query, $instructoresRegistrados, $franja_id, $dia, $trimestre, $instructor_id, $ano)
    {
        $instructores = $query->orderBy('nombre')
            ->whereDoesntHave('horarios', function($query) use($instructoresRegistrados, $franja_id, $dia, $trimestre, $instructor_id, $ano) {
                $query->whereIn('horarios.instructor_id', $instructoresRegistrados)
                ->where('horarios.franja_id', $franja_id)
                ->where('horarios.dia', $dia)
                ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
                ->where('programaciones.trimestre', $trimestre)
                ->where('programaciones.ano', $ano)
                ->where('users.id', '!=', $instructor_id);
            });

        return $instructores;
    }

    public function calcularHorasAcumuladas()
    {
        $trimestres = Trimestre::where('programando', true)->first();

        if(!empty($trimestres)) {
            $horasAcumuladas = $this->selectRaw('SUM(TO_SECONDS(franjas.horaFin) - TO_SECONDS(franjas.horaInicio)) as horasAcumuladas')
                ->where('users.id', $this->id)
                ->join('horarios', 'users.id', '=', 'horarios.instructor_id')
                ->join('franjas', 'horarios.franja_id', '=', 'franjas.id')
                ->join('programaciones', 'horarios.programacion_id', '=', 'programaciones.id')
                ->where('programaciones.trimestre', $trimestres->trimestre)
                ->where('programaciones.ano', $trimestres->ano)
                ->first();

            $horasActividades = $this->selectRaw('TIME_TO_SEC(otras_actividades.horas) as horasActividades')
                ->join('otras_actividades', 'users.id', '=', 'otras_actividades.user_id')
                ->where('users.id', $this->id)
                ->where('otras_actividades.trimestre', $trimestres->trimestre)
                ->where('otras_actividades.ano', $trimestres->ano)
                ->first();

            if($horasActividades) {
                $tiempo = $horasAcumuladas->horasAcumuladas + $horasActividades->horasActividades;
                $hora   = floor($tiempo / 3600);
                $min    = floor($tiempo / 60 % 60);
                $seg    = floor($tiempo % 60);

                $horasTotales = sprintf('%02d:%02d:%02d', $hora, $min, $seg);
            } else {
                $tiempo = $horasAcumuladas->horasAcumuladas;
                $hora   = floor($tiempo / 3600);
                $min    = floor($tiempo / 60 % 60);
                $seg    = floor($tiempo % 60);

                $horasTotales = sprintf('%02d:%02d:%02d', $hora, $min, $seg);
            }

            return $horasTotales;
        }
    }

    public function horario()
    {
        $trimestres = Trimestre::where('activo', true)->firstOrFail();

        return $this->horarios()->select('ambientes.nombre as nombreAmbiente', 'horarios.fechaInicio', 'horarios.fechaFin', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'horarios.dia', 'programas_formacion.nombre as programaFormacionNombre', 'programas_formacion.numeroFicha')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->join('franjas', 'horarios.franja_id', 'franjas.id')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->join('ambientes', 'horarios.ambiente_id', 'ambientes.id')
            ->join('programas_formacion', 'programaciones.programa_formacion_id', 'programas_formacion.id')
            ->where('programaciones.trimestre', !empty($trimestres) ? $trimestres->trimestre : null)
            ->where('programaciones.ano', !empty($trimestres) ? $trimestres->ano : null)
            ->where('horarios.instructor_id', $this->id);
    }

    public function obtenerHorarioProgramado($trimestre, $ano)
    {
        return $this->horarios()->select('ambientes.nombre as nombreAmbiente', 'horarios.fechaInicio', 'horarios.fechaFin', 'users.nombre as nombreInstructor', 'horarios.franja_id', 'horarios.dia', 'programas_formacion.nombre as programaFormacionNombre', 'programas_formacion.numeroFicha')
            ->join('users', 'horarios.instructor_id', 'users.id')
            ->join('franjas', 'horarios.franja_id', 'franjas.id')
            ->join('programaciones', 'horarios.programacion_id', 'programaciones.id')
            ->join('ambientes', 'horarios.ambiente_id', 'ambientes.id')
            ->join('programas_formacion', 'programaciones.programa_formacion_id', 'programas_formacion.id')
            ->where('programaciones.trimestre', $trimestre)
            ->where('programaciones.ano', $ano)
            ->where('horarios.instructor_id', $this->id);
    }
}
