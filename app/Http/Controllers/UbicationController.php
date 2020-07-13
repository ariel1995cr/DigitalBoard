<?php

namespace App\Http\Controllers;

use App\Ubication;
use Illuminate\Http\Request;

class UbicationController extends Controller
{
    //
    public function listarUbicaciones()
    {
        return response()->Json(Ubication::all());
    }
}
