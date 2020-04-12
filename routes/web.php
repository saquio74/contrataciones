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

Route::get('/',                              'PagesController@index');

Route::get('/agente/agente',                 'agentes@index');

Route::get('/agente/activos',                'agentes@activos');

Route::get('/agente/bajas',                  'agentes@bajas');

Route::get('/agente/agentes',                'agentes@vistaAgentes');

Route::get('/agentes/nuevo',                 'agentes@nuevo');

Route::get('/agentes/buscar',                'agentes@buscar');

Route::get('/agente/porhospital/{hospital}', 'agentes@porHospital');

Route::get('/agente/porservicio/{servicio}', 'agentes@porservicio');

Route::get('/agente/modificar',              'agentes@modificar');

Route::post('/agente/update',                'agentes@update');

Route::post('/agente/store',                 'agentes@store');

Route::post('/agente',                       'agentes@modificar');

Route::get('/agente/{legajo}',               'agentes@show');

Route::get('/hospitales',                    'hospitales@index');

Route::get('/hospitales/{id}',               'hospitales@show');

Route::get('/servicios',                     'servicios@index');

Route::get('/sectores',                      'sectores@index');

Route::get('/incisos',                       'incisos@index');

Route::get('/agenincs',                      'agenincs@index');

Route::post('/agenincs/hosp',                 'agenincs@incisoAgente');

Route::get('/agenincs/{legajo}',             'agenincs@incisoPorAgente');

Route::get('/vacaciones',                    'vacacion@vistaVacaciones');

Route::get('/vacaciones/vacaciones',         'vacacion@listadoVacaciones');

Route::post('/vacaciones/store',             'vacacion@store');

Route::post('/vacaciones/update',            'vacacion@update');

Route::delete('/vacaciones/delete/{id}',     'vacacion@delete');

Route::get('/agenfac',                       'agenfacs@index');

Route::post('/agenfac/store',                'agenfacs@store');

Route::post('/agenfac/verificar',            'agenfacs@getFacturacion');