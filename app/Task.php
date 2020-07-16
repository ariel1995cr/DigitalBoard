<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //Campos de asignación masiva.
    protected $fillable = ['nombre','latitud','longitud','direccion','descripcion','inicio','fin'];


    //Relacion entre Tareas y Ubicacion.
    public function taskUbication()
    {
        return $this->hasOne('App\Ubication','id');
    }
}
