<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\agente;
use App\hospital;
use App\inciso;
use App\sector;
use App\servicio;
use App\ageninc;
use DB;
class agentes extends Controller
{
    public function index(){
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->orderBy('created_at', 'desc')
                    ->get();
        $agente = json_encode($agente);
        return $agente;
        
    }
    public function vistaAgentes()
    {
        return view('agente.agentes');
    }


    public function show($legajo)
    {
        $agente = agente::where('legajo',$legajo)->get();
        return view('agente.show', compact('agente'));
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

        $this->validate($request,[
            'legajo'=>'required',
            'dni'=>'required',
            'nombre'=>'required',
            'idhosp'=>'required',
            'inciso'=>'required',
            'sec'=>'required',
            'idservicio'=>'required',
            'horario'=>'required'
        ]);
        
        $agente = agente::where('legajo',$request->legajo)->get();
        if(count($agente)>=1){

        }else{
            $agente = agente::where('dni',$request->dni)->get();
        }
        try {
            if(count($agente)>=1) {

                $mensaje = 'el agente ya existe';
                return view('Agente.show', compact('agente','mensaje'));
            } else {
                agente::create($request->all());
                
                for($i=0; $i<count($request->inciso);$i++){
                    $incisos = new ageninc;
                    $incisos->idagente=$request->legajo;
                    $incisos->idinc=$request->inciso[$i];
                    $incisos->save();
                    
                }
                
                $agente = agente::where('legajo',$request->legajo)->get();

                return view('agente.show', compact('agente'));
        
            }
        } catch (\Throwable $th) {
            //throw $th;
            return 'ocurrio algun problema';
        }
    }
    public function buscar()
    {
        return view('agente.buscar');
    }

    public function modificar(Request $request)
    {
        $agente = agente::where('legajo',$request->legajo)->get();
        if(count($agente)==0){
            $agente = agente::where('dni',$request->legajo)->get();
        }

        $inc = ageninc::where('idagente',$request->legajo)->get();
        
        $hospitales = hospital::all();
        $inciso = inciso::all();
        $sector = sector::all();
        $servicio = servicio::all();
        return view('agente.modificar', compact('hospitales','inciso','sector','servicio','agente','inc'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'legajo'=>'required',
            'dni'=>'required',
            'nombre'=>'required',
            'idhosp'=>'required',
            'inciso'=>'required',
            'sec'=>'required',
            'idservicio'=>'required',
            'horario'=>'required'
        ]);

        $agente = agente::where('legajo',$request->legajo)->get();
        if(count($agente)>=1){
            ageninc::where('idagente', $request->legajo)->delete();
            agente::whereLegajo($request->legajo)->update($request->except('_token','inciso','legajo','created_at','fecha_ingreso'));
            for($i=0; $i<count($request->inciso);$i++){
                $incisos = new ageninc;
                $incisos->idagente=$request->legajo;
                $incisos->idinc=$request->inciso[$i];
                $incisos->save();
                        
            }
            $agente = agente::where('legajo',$request->legajo)->get();
            return view('agente.show', compact('agente'));
        }else{
            $agente = agente::where('dni',$request->dni)->get();
            if(count($agente)>=1){
                ageninc::where('idagente', $request->legajo)->delete();
                agente::whereDni($request->dni)->update($request->except('_token','inciso','created_at','dni','fecha_ingreso'));
                for($i=0; $i<count($request->inciso);$i++){
                    $incisos = new ageninc;
                    $incisos->idagente=$request->legajo;
                    $incisos->idinc=$request->inciso[$i];
                    $incisos->save();
                            
                }
                return view('agente.show', compact('agente'));
            }else{
                return 'no puede cambiar el campo LEGAJO y DNI al mismo tiempo';
            }
            
            
            
        }


        
    }
    

}
