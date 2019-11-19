<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramacionRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'fechaInicio'           => 'required|date|date_format:Y-m-d|before_or_equal:fechaFin',
            'fechaFin'              => 'required|date|date_format:Y-m-d|after_or_equal:fechaInicio',
            'programa_formacion_id' => 'required',
            'municipio_id'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fechaInicio.required'          => 'La fecha inicial de la convocatoria es obligatoria',
            'fechaInicio.date'              => 'Este campo debe ser una fecha',
            'fechaFin.required'             => 'La fecha final de la convocatoria es obligatoria',
            'fechaFin.date'                 => 'Este campo debe ser una fecha',
            'programa_formacion_id.required'=> 'El programa de formación es obligatorio',
            'municipio_id.required'         => 'El municipio es obligatorio',
        ];
    }
}
