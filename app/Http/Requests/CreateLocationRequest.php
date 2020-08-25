<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocationRequest extends FormRequest
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
            'locacion.name'         => 'required|string|unique:location,name',
            'locacion.description'    => 'nullable',
            'locacion.latitud'        => 'required_if:locacion.tipoIngreso,Coordenadas',
            'locacion.longitud'       => 'required_if:locacion.tipoIngreso,Coordenadas',
            'locacion.direction'      => 'required_if:locacion.tipoIngreso,Dirección',
            'locacion.tipoIngreso'    => 'required'
        ];
    }
}
