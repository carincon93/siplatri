<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaFormacionRequest extends FormRequest
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
            'nombre'                => 'required|max:191',
            'numeroFicha'           => 'required|max:20|unique:programas_formacion,numeroFicha,'.$this->route('programas_formacion').',id',
            'tipoFormacion'         => 'required|max:191',
            'duracion'              => 'required|max:191',
            'modalidad'             => 'required|max:191',
            'cantidadAprendices'    => 'required|max:11',
            'fechaInicioLectiva'    => 'required|date|date_format:Y-m-d|before:fechaFinPrograma',
            'fechaFinLectiva'       => 'nullable|date|date_format:Y-m-d|after:fechaInicioLectiva',
            'fechaFinPrograma'      => 'required|date|date_format:Y-m-d|after:fechaInicioLectiva',
            'gestor_id'             => 'required',
        ];
    }
}
