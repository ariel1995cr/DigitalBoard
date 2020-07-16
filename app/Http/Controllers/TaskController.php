<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUbicationCreateRequest;
use App\Task;
use App\Ubication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view('prueba');
    }


    public function listarTareas()
    {
        return Task::all();
    }

    public function crearTarea(TaskUbicationCreateRequest $request)
    {
        $inicio = Carbon::createFromFormat('d-m-Y', $request->task['inicio'])->format('Y-m-d');
        $fin = Carbon::createFromFormat('d-m-Y', $request->task['fin'])->format('Y-m-d');

        $task = new Task($request->task);

        $task->inicio = $inicio;
        $task->fin = $fin;


        return $task->save();
    }
}
