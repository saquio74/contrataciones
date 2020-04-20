<?php

namespace App\Http\Controllers;

use App\especialidad;
use Illuminate\Http\Request;
use Maatwebsite\Excel\facades\Excel;
use App\imports\especialidadImport;
class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = especialidad::all();
        return $especialidades;
    }
    public function importExcel(Request $request)
    {
        
        
        $file = $request->file('files');
        //dd($file);
        Excel::import(new especialidadImport,$file);
    }
    public function vistaExcel()
    {
        return view('importExcel');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show(especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit(especialidad $especialidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, especialidad $especialidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(especialidad $especialidad)
    {
        //
    }
}
