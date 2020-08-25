<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Requests\CreateLocationRequest;

class LocationController extends Controller
{
    //
    public function create(CreateLocationRequest $data){

        $location = new Location($data->locacion);        
        return $location->save(); 

    }


    public function listarUbicaciones()
    {
        return response()->Json(Location::all());
    }
}
