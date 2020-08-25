<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/prueba', 'TaskController@index');

//RUTAS TAREAS
////CREAR
Route::post('locacion', 'LocationController@create');
////LSITAR
Route::get('/task', 'TaskController@listarTareas');
////BUSCAR TAREA
Route::get('/task/{latitud}/{longitud}', 'TaskController@buscarTareas');

//RUTAS UBICACIONES
///LISTAR UBICACIONES
Route::get('/ubication', 'LocationController@listarUbicaciones');
