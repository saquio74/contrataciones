<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\agente;
use App\hospital;
use App\inciso;
use App\sector;
use App\servicio;
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
            return view('agente.show', compact('agente'));
        }else{
            return view('agente.show', compact('agente'));
        }
        
    }
    public function nuevo()
    {
        $hospitales = hospital::all();
        $inciso = inciso::all();
        $sector = sector::all();
        $servicio = servicio::all();
        
        return view('agente.nuevo', compact('hospitales','inciso','sector','servicio'));
    }
    public function store(Request $agente)
    {
        dd($agente->all());
        
        return $agente;

    }
}
