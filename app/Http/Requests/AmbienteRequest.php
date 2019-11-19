<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbienteRequest extends FormRequest
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
            'nombre'        => 'required|max:191',
            'estado'        => 'required',
            'usabilidad'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'       => 'El nombre es obligatorio',
            'nombre.max'            => 'El nombre no puede superar los 191 caracteres',
            'estado.required'       => 'El estado es obligatorio',
            'usabilidad.required'   => 'La usabilidad es obligatoria',
        ];
    }
}
