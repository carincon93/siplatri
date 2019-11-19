<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'zona_id',
    ];

    public function programaciones()
    {
        return $this->hasMany('App\Programacion');
    }

    public function zona()
    {
        return $this->belongsTo('App\Zona');
    }
}
