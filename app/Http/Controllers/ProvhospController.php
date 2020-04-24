<?php

namespace App\Http\Controllers;

use App\provhosp;
use Illuminate\Http\Request;
use Maatwebsite\Excel\facades\Excel;
use App\imports\provhospImport;

class ProvhospController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function importExcel(Request $request)
    {
        
        
        $file = $request->file('files');
        //dd($file);
        Excel::import(new provhospImport,$file);
    }
    public function vistaExcel()
    {
        return view('importProvhosp');
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
     * @param  \App\provhosp  $provhosp
     * @return \Illuminate\Http\Response
     */
    public function show(provhosp $provhosp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\provhosp  $provhosp
     * @return \Illuminate\Http\Response
     */
    public function edit(provhosp $provhosp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\provhosp  $provhosp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, provhosp $provhosp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\provhosp  $provhosp
     * @return \Illuminate\Http\Response
     */
    public function destroy(provhosp $provhosp)
    {
        //
    }
}
