<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoAprendizaje extends Model
{
    protected $table = 'resultados_aprendizaje';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
        'competencia_id',
        'horas',
    ];

    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }

}
