<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskUbicationCreateRequest;
use App\State;
use App\Task;
use App\Ubication;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        return DB::table('tasks')
                ->select('latitud','longitud', DB::raw('count(*) as totalTareas, latitud'))
                ->groupBy('latitud','longitud')
                ->get();
    }

    public function buscarTareas($latitud = 0, $longitud = 0)
    {
        return Task::coordinates($latitud,$longitud)->with('taskState')->get();
    }

    public function crearTarea(TaskUbicationCreateRequest $request)
    {
        $task = new Task($request->task);

        if(!is_null($request->task['inicio'])){
            $inicio = Carbon::createFromFormat('d-m-Y', $request->task['inicio'])->format('Y-m-d');
            $task->inicio = $inicio;
        }
        if(!is_null($request->task['fin'])){
            $fin = Carbon::createFromFormat('d-m-Y', $request->task['fin'])->format('Y-m-d');
            $task->fin = $fin;
        }

        $task->save();

        $task->taskState()->attach('Proceso');

        return response()->json(true);
    }
}
