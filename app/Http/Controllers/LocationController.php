<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function listarUbicaciones()
    {
        return response()->Json(Location::all());
    }
}
