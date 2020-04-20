<?php

namespace App\Http\Controllers;

use App\libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firma = libro::all();

        return $firma;
    }
   
    public function store(Request $firma)
    {
        $this->validate($firma,[
            'agente_id'     =>  'required',
            'hospital_id'   =>  'required',
            'added_on'      =>  'required'
        ]);
        agente::create($firma->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(libro $libro)
    {
        $this->validate($libro,[
            'agente_id'     =>  'required',
            'hospital_id'   =>  'required',
            'added_on'      =>  'required'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(libro $libro)
    {
        //
    }
}
