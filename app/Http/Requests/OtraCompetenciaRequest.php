<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtraCompetenciaRequest extends FormRequest
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
            'ambiente_id'           => 'required',
            'instructor_id'         => 'required',
            'competencia_id'        => 'required',
        ];
    }
}
