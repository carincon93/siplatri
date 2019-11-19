<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrimestreRequest extends FormRequest
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
            'fechaInicio'   => 'required|date|date_format:Y-m-d|before:fechaFin',
            'fechaFin'      => 'required|date|date_format:Y-m-d|after:fechaInicio',
            'trimestre'     => 'required|max:11',
            'activo'        => 'max:1',
            'programando'   => 'max:1',
        ];
    }
}
