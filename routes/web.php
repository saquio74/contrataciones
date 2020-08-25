<?php

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',                              'PagesController@index');

Route::post('/login',                        'Auth\LoginController@login');

Route::post('/logout',                       'Auth\LoginController@logout');

Route::post('/register',                     'authController@signup');

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

Route::post('/agenincs/hosp',                'agenincs@incisoAgente');

Route::get('/agenincs/{legajo}',             'agenincs@incisoPorAgente');

Route::get('/vacaciones',                    'vacacion@vistaVacaciones');

Route::get('/vacaciones/vacaciones',         'vacacion@listadoVacaciones');

Route::post('/vacaciones/store',             'vacacion@store');

Route::post('/vacaciones/update',            'vacacion@update');

Route::delete('/vacaciones/delete/{id}',     'vacacion@delete');

Route::get('/agenfac',                       'agenfacs@index');

Route::post('/agenfac/store',                'agenfacs@store');

Route::post('/agenfac/verificar',            'agenfacs@getFacturacion');

Route::post('/agenfac/liquidacionpdf',       'agenfacs@liquidacionPDF');

Route::post('/agenfac/excel',                'agenfacs@excelLiquidacion');

Route::post('/agenfac/modificar',            'agenfacs@getModificar');

Route::delete('/agenfac/delete/{id}',        'agenfacs@delete');

Route::get('/agenfac/periodo',               'agenfacs@getPeriodo');

Route::post('/agenfac/liquidacion',          'agenfacs@getLiquidacion');

Route::get('/libro',                         'libroController@index');

Route::get('/especialidad/vistaExcel',       'especialidadController@vistaExcel');

Route::post('/especialidad/excelImport',     'especialidadController@importExcel');

Route::get('/proveedor/vistaExcel',          'proveedorController@VistaExcel');

Route::get('/proveedor',                     'proveedorController@index');

Route::get('/proveedor/{id}',                'proveedorController@show');

Route::post('/proveedor/excelImport',        'proveedorController@importExcel');

Route::get('/contrato/vistaExcel',           'contratoController@VistaExcel');

Route::post('/contrato/excelImport',         'contratoController@importExcel');

Route::get('/provhosp/vistaExcel',           'provhospController@VistaExcel');

Route::post('/provhosp/excelImport',         'provhospController@importExcel');

Route::get('/contrato/activos',              'ContratoController@activos');

Route::get('/contrato/bajas',                'contratoController@bajas');

Route::post('/proveedor/nuevo',              'proveedorController@store');

Route::put('/proveedor/update',              'proveedorController@update');

Route::get('/especialidades',                'EspecialidadController@index');

Route::post('/contratos/store',              'contratoController@store');

Route::delete('/contrato/delete/{id}',       'contratoController@delete');

Route::get('/permission',                    'permissionController@index');

Route::get('/user',                          'authController@getUsuarios');

Route::get('/roles',                         'rolesController@index');

Route::get('/roles/{id}',                    'rolesController@show');