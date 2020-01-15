<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\agente;
use App\hospital;
use App\inciso;
use App\sector;
use App\servicio;
use App\ageninc;
class agentes extends Controller
{
    public function index(){
        $gente = agente::all()->sortByDesc('created_at');
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
    public function store(Request $request)
    {
        /*$this->validate($request,[
            'legajo'=>'required',
            'dni'=>'required',
            'nombre'=>'required',
            'hospital'=>'required',
            'inciso'=>'required'


        ]);*/
        $agente = agente::where('legajo',$request->legajo)->get();
        
        $inciso = new ageninc;
        
        
        
        try {
            if(count($agente)>=1) {

                return view('agente.show', compact('agente'));
            } else {
                $inciso->idagente=$request->legajo;
                $inciso->idinc=$request->inciso;
                agente::create($request->all());
                $inciso->save();
                $agente = agente::where('legajo',$request->legajo)->get();
                
                
                return view('Agente.show', compact('agente'));
            }
            

            
        } catch (\Throwable $th) {
            //throw $th;
            return 'ocurrio algun problema';
        }
    }
}
