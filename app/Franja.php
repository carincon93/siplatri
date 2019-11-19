<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franja extends Model
{
    protected $table = 'franjas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'horaInicio',
        'horaFin',
    ];

    public function horarios()
    {
        return $this->hasMany('App\Horario');
    }
}
