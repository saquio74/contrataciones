<?php

namespace App\Http\Controllers;

use App\proveedor;
Use App\provhosp;
use Illuminate\Http\Request;
use Maatwebsite\Excel\facades\Excel;
use App\imports\proveedorImport;

class ProveedorController extends Controller
{
    
    public function index()
    {
        $proveedor = proveedor::all();

        return $proveedor;
    }
    public function importExcel(Request $request)
    {
        
        
        $file = $request->file('files');
        //dd($file);
        Excel::import(new proveedorImport,$file);
    }
    public function vistaExcel()
    {
        return view('importProveedores');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'proveedor'     =>'required',
            'nombre'        =>'required',
            'apellido'      =>'required',
            'dni'           =>'required',
            'cuil'          =>'required',
            'genero'        =>'required',
            'matricula'     =>'required',
            'hospital'      =>'required'
            
        ]);
        proveedor::create($request->all());
        $proveedor = proveedor::where('dni',$request->dni)->get();
        $hospital_id    = $request->hospital;
        $proveedor_id   = $proveedor[0]->id;
        
        $provhosp = new provhosp;
        $provhosp->proveedor_id = $proveedor_id;
        $provhosp->hospital_id  = $hospital_id;
        $provhosp->save();
        return $proveedor_id;
        
    }
    public function show($proveedor)
    {
        $proveedor = proveedor::where('proveedor',$proveedor)->get();
        return $proveedor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(proveedor $proveedor)
    {
        //
    }
}
