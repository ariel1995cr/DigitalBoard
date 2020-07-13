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
            //
            'task.nombre'         => 'required|string',
            'task.inicio'         => 'date|date_format:d-m-Y|after_or_equal:'.Carbon::now()->format('d-m-Y').'',
            'task.fin'            => 'date|date_format:d-m-Y|after_or_equal:'.$this->task['inicio'].'',
            'task.descripcion'    => 'nullable',
            'task.created_at'     => 'nullable',
            'task.updated_at'     => 'nullable',
            'ubication.id'        => 'required_if:existeUbicacion,true',
            'ubication.direccion' => 'required_if:existeUbicacion,false',
            'ubication.nombre'    => 'required_if:existeUbicacion,false',
            'ubication.latitud'   => 'required_if:existeUbicacion,false',
            'ubication.longitud'  => 'required_if:existeUbicacion,false',
        ];
    }
}
