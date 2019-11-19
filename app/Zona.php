<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zonas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

    public function municipios()
    {
        return $this->hasMany('App\Municipio');
    }

    public function instructores()
    {
        return $this->belongsToMany('App\User', 'instructor_zona', 'zona_id', 'user_id');
    }
}
