<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetenciaRequest extends FormRequest
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
            'descripcion'           => 'required',
            'resumen'               => 'required',
            'codigo'                => 'required|max:20',
            'programa_formacion_id' => 'required',
            'duracionHoras'         => 'required|max:11',
        ];
    }
}
