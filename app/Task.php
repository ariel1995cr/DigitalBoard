<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['nombre','direccion','latitud','longitud'];

    public function taskUbication()
    {
        return $this->hasOne('App\Ubication','id');
    }
}
