<?php

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

Route::get('/', 'ActividadController@index');

Route::post('/actividad', 'ActividadController@validar');

Route::post('/actividad/deleteActividad','ActividadController@deleteActividad');

Route::post('/actividad/buscar','ActividadController@buscar');





