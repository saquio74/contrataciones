<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vacaciones;
use DB;
class vacacion extends Controller
{
    public function index()
    {
        $vacaciones = vacaciones::all();
        $vacaciones = json_encode($vacaciones);
        return $vacaciones;
    }
    public function vistaVacaciones()//devuelve la vista de vacaciones
    {
        return view('vacaciones.vacaciones');
    }

    public function listadoVacaciones()
    {
        $vacaciones = DB::table('vacaciones')
                        ->select('vacaciones.id','agente_id','anio','fecha_inicio','fecha_fin','DNI','NOMBRE','SEC','HOSPITAL','LEGAJO')
                        ->join('agentes','agente_id','=','agentes.legajo')
                        ->join('hospitales','agentes.idhosp','=','hospitales.id')
                        
                        ->get();
        
        $vacaciones = json_encode($vacaciones);
        return $vacaciones;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'agente_id'     => 'required',
            'anio'          => 'required',
            'fecha_inicio'  => 'required',
            'fecha_fin'     => 'required',
        ]);
        $carbon_fecha_ini= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio);
        $carbon_fecha_fin= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_fin);
        

        $request->fecha_inicio = $carbon_fecha_ini;
        $request->fecha_fin = $carbon_fecha_fin;
        
        vacaciones::create($request->all());
        
    }
    public function delete($id)
    {
        $delete = vacaciones::where('id',$id)->delete();
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'id'            => 'required',
            'agente_id'     => 'required',
            'anio'          => 'required',
            'fecha_inicio'  => 'required',
            'fecha_fin'     => 'required',
        ]);
        $carbon_fecha_ini= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio);
        $carbon_fecha_fin= \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_fin);
        
        $request->fecha_inicio = $carbon_fecha_ini;
        $request->fecha_fin = $carbon_fecha_fin;
        
        vacaciones::where('id' , '=', $request->id)->update($request->except('id'));
    }
}
