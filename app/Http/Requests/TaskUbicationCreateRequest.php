<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskUbicationCreateRequest extends FormRequest
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
            'task.nombre'         => 'required|string|unique:tasks,nombre',
            'task.inicio'         => 'nullable|date|date_format:d-m-Y|after_or_equal:'.Carbon::now()->format('d-m-Y').'',
            'task.fin'            => 'nullable|date|date_format:d-m-Y|after_or_equal:'.$this->task['inicio'].'',
            'task.descripcion'    => 'nullable',
            'task.created_at'     => 'nullable',
            'task.updated_at'     => 'nullable',
            'task.latitud'        => 'required_if:task.tipoIngreso,Coordenadas',
            'task.longitud'       => 'required_if:task.tipoIngreso,Coordenadas',
            'task.direccion'      => 'required_if:task.tipoIngreso,Direccion',
            'task.tipoIngreso'    => 'required'
        ];
    }
}
