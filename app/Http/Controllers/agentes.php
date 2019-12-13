<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\agente;
class agentes extends Controller
{
    public function index(){

        //$gente = \DB::table('agentes')->select('LEGAJO','NOMBRE')->get();
        
        
        $gente = agente::all();

        return view('Agente.agentes', compact('gente'));
    }
    public function show($legajo)
    {
        
        $agente = agente::where('legajo',$legajo)->get();
        
        //$agente = agente::find('legajo');

        
        if($agente->isEmpty()){
            return view('agente.show');
        }else{
        return view('agente.show', compact('agente'));
        }
        
    }
}
