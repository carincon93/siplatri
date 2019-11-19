<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    protected $table = 'trimestres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ano',
        'trimestre',
        'fechaInicio',
        'fechaFin',
        'activo',
        'programando',
    ];
}
