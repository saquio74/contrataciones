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

Route::get('/', 'PagesController@index');

Route::get('/agente/agente','agentes@index');

Route::get('/agente/agentes','agentes@vistaAgentes');

Route::get('/agentes/nuevo', 'agentes@nuevo');

Route::get('/agentes/buscar', 'agentes@buscar');

Route::get('/agente/modificar', 'agente@modificar');

Route::post('/agente', 'agentes@update');

Route::post('/agente', 'agentes@store');

Route::post('/agentes', 'agentes@modificar');

Route::get('/agentes/{legajo}', 'agentes@show');

Route::get('/hospitales','hospitales@index');

Route::get('/hospitales/{id}','hospitales@show');



