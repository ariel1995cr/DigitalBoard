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

    public function scopeCoordinates($q, $lat, $long)
    {
        return $q->where('latitud','=',$lat)->where('longitud','=',$long);
    }

    public function taskState()
    {
        return $this->belongsToMany('App\State', 'task_state', 'task_id', 'state_id');
    }
}
