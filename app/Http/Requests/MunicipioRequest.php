<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicipioRequest extends FormRequest
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
            'nombre' => 'required|max:191',
            'zona'   => 'required|max:191',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max'      => 'El nombre no puede superar los 191 caracteres',
            'zona.required'   => 'La zona es obligatoria',
            'zona.max'      => 'La zona no puede superar los 191 caracteres',
        ];
    }
}
