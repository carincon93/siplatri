<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtraActividad extends Model
{
    protected $table = 'otras_actividades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_actividad',
        'dia',
        'horas',
        'user_id',
    ];

    public function personal()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
