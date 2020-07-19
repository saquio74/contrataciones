<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
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
    public function index(){//listado general de agentes
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->orderBy('legajo', 'asc')
                    ->get();
        //$agente = json_encode($agente);
        return $agente;
        
    }
    public function activos(){//listado de agentes activos
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->where('agentes.activo','=',0)
                    ->orderBy('legajo', 'desc')
                    ->get();
        //$agente = json_encode($agente);
        return $agente;
        
    }
    public function bajas(){//listado general de agentes de baja
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->where('agentes.activo','=',1)
                    ->orderBy('legajo', 'desc')
                    ->get();
        //$agente = json_encode($agente);
        return $agente;
        
    }
    public function porHospital($hospital){//listado de agentes activos filtrado por hospital
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->where('hospitales.id', '=',$hospital)
                    ->where('agentes.activo','=',0)
                    ->orderBy('legajo', 'asc')
                    ->get();
        //$agente = json_encode($agente);
        return $agente;
        
    }
    public function porServicio($servicio){//listado de agentes activos filtrado por servicio
        $agente = DB::table('agentes')
                    ->join('hospitales','idhosp','=','hospitales.id')
                    ->join('servicio','idservicio','=','servicio.id')
                    ->join('sector','sec','=','sector.id')
                    ->where('servicio.id', '=',$servicio)
                    ->where('agentes.activo','=',0)
                    ->orderBy('legajo', 'asc')
                    ->get();
        //$agente = json_encode($agente);
        return $agente;
        
    }
    
    public function vistaAgentes()//devuelve la vista de agentes
    {
        return view('agente.agentes');
    }


    public function show($legajo)//muestra todos los datos del agente
    {
        $agente = agente::where('legajo',$legajo)->get();
        return view('agente.show', compact('agente'));
    }
    public function nuevo()//vista para ingresar un agente
    {
        $hospitales = hospital::all();
        $inciso = inciso::all();
        $sector = sector::all();
        $servicio = servicio::all();
        return view('agente.nuevo', compact('hospitales','inciso','sector','servicio'));
    }
    public function store(Request $request)//ingresa un agente
    {

        $this->validate($request,[
            'legajo'    =>'required',
            'dni'       =>'required',
            'nombre'    =>'required',
            'idhosp'    =>'required',
            'inciso'    =>'required',
            'sec'       =>'required',
            'idservicio'=>'required',
            'horario'   =>'required'
        ]);
        
        $agente = agente::where('legajo',$request->legajo)->get();
        if(count($agente)>=1){//verifica que no existe un agente con dicho legajo

        }else{//verifica que no exista un agente con mismo DNI
            $agente = agente::where('dni',$request->dni)->get();
        }
        try {
            if(count($agente)>0) {//si existe devuelve el mensaje de error

                $message = 'el agente ya existe';
                return response::json(array(
                    'code'      =>  401,
                    'message'   =>  $message
                ), 401);
            } else {
                agente::create($request->all());//ingresa a dicho agente
                
                for($i=0; $i<count($request->inciso);$i++){//ingresa los incisos
                    $incisos = new ageninc;
                    $incisos->idagente=$request->legajo;
                    $incisos->idinc=$request->inciso[$i];
                    $incisos->save();
                    
                }
                
                $agente = agente::where('legajo',$request->legajo)->get();
                $msj = 'ingresado satisfactoriamente';
                return response::json($msj,200);
        
            }
        } catch (\Throwable $th) {
            //throw $th;
            $message = 'el agente ya existe';
                return response::json(array(
                    'code'      =>  401,
                    'message'   =>  $message
                ), 401);
        }
    }
    public function buscar()//retorna la vista buscar
    {
        return view('agente.buscar');
    }
    

    public function modificar(Request $request)
    {
        $agente = agente::where('legajo',$request->legajo)->get();//busca al agente
        if(count($agente)==0){
            $agente = agente::where('dni',$request->legajo)->get();//verifica si el agente ingresado con DNI
        }

        $inc = ageninc::where('idagente',$request->legajo)->get();//busca los incisos del agente
        
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
        
        $agente = agente::where('legajo',$request->legajo)->get();//busco al agente por LEGAJO
        if(count($agente)>=1){//verifica que exista
            ageninc::where('idagente', $request->legajo)->delete();//borra todos los incisos para volver a ingresarlos
            agente::whereLegajo($request->legajo)->update($request->except('_token','inciso','legajo','created_at','fecha_ingreso'));
            //actualiza todos los datos 
            for($i=0; $i<count($request->inciso);$i++){//vuelve a ingresar los incisos seleccionados
                $incisos = new ageninc;
                $incisos->idagente=$request->legajo;
                $incisos->idinc=$request->inciso[$i];
                $incisos->save();
            }
            $agente = agente::where('legajo',$request->legajo)->get();//vuelve a buscar al agente
            $msj = 'actualizado satisfactoriamente';
            return response::json($msj,200);
        }else{
            $agente = agente::where('dni',$request->dni)->get();//busco al agente por DNI
            if(count($agente)>=1){
                ageninc::where('idagente', $request->legajo)->delete();//borra todos los incisos para volver a ingresarlos
                agente::whereDni($request->dni)->update($request->except('_token','inciso','created_at','dni','fecha_ingreso'));
                //actualiza todos los datos 
                for($i=0; $i<count($request->inciso);$i++){//vuelve a ingresar los incisos seleccionados
                    $incisos = new ageninc;
                    $incisos->idagente=$request->legajo;
                    $incisos->idinc=$request->inciso[$i];
                    $incisos->save();
                }
                $msj = 'ingresado satisfactoriamente';
                return response::json($msj,200);
            }else{
                return 'no puede cambiar el campo LEGAJO y DNI al mismo tiempo';
            }
        }
    }

    

}
