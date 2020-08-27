<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ageninc;
use App\inciso;
use DB;
class agenincs extends Controller
{
    public function index()
    {
        //$hospitales = \DB::table('hospitales')->select('hospital')->get();
        $ageninc = ageninc::all();
        
        return $ageninc;
    }
    public function incisoPorAgente($legajo){
        $inciso = DB::table('ageninc')
                    ->join('inciso','idinc','=','inciso.id')
                    ->select('inciso.ID','inciso.INCISO','inciso.VALOR')
                    ->where('idagente','=',$legajo)
                    ->get();
        
        
        return $inciso;
    }
    public function incisoAgente(Request $datos)
    {
        
        
        $inciso = DB::table('ageninc')
                    ->join('inciso','idinc','=','inciso.id')
                    ->join('agentes','idagente','=','agentes.LEGAJO')
                    ->select('inciso.ID','inciso.INCISO','inciso.VALOR','agentes.IDSERVICIO','agentes.SEC','agentes.IDHOSP','ageninc.IDAGENTE','agentes.NOMBRE')
                    ->orderBy('IDAGENTE', 'asc')
                    ->where('agentes.IDHOSP','=',$datos->hospitalId)
                    ->where('agentes.SEC','=',$datos->sectorId)
                    ->where('agentes.IDSERVICIO','=',$datos->servicioId)
                    ->where('agentes.ACTIVO','=',0)
                    ->get();
        
        
        return response()->json([$inciso],200);

    }
}
