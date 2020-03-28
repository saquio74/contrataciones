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
        $ageninc = json_encode($ageninc);
        return $ageninc;
    }
    public function incisoPorAgente($legajo){
        $inciso = DB::table('ageninc')
                    ->join('inciso','idinc','=','inciso.id')
                    ->select('inciso.ID','inciso.INCISO','inciso.VALOR')
                    ->where('idagente','=',$legajo)
                    ->get();
        
        $inciso = json_encode($inciso);
        return $inciso;
    }
}
