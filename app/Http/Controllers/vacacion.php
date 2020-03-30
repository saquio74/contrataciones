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
                        ->join('agentes','agente_id','=','agentes.legajo')
                        ->join('hospitales','agentes.idhosp','=','hospitales.id')
                        ->get();
        
        $vacaciones = json_encode($vacaciones);
        return $vacaciones;
    }
    
}
