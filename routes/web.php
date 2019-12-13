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

Route::get('/agentes', 'agentes@index');

Route::get('/agentes/{legajo}', 'agentes@show');

Route::get('/hospitales','hospitales@index');

Route::get('/hospitales/{id}','hospitales@show');


