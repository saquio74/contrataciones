<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agenfac;
Use DB;
class agenfacs extends Controller
{
    public function index()
    {
        $agenfac = agenfac::all();
        return $agenfac;
    }

    public function getFacturacion(Request $datos)
    {
        $agenfac =DB::table('agenfac')
                    ->where('LEG', '=', $datos->leg)
                    ->where('PERIODO', '=', $datos->periodo)
                    ->where('ANIO', '=', $datos->anio)
                    //->where('HORAS', '=', $datos->HORAS)
                    ->get();
        
        return $agenfac; 
    }
    public function getLiquidacion(Request $datos){
        $agenfac = DB::table('agenfac')
                    ->where('PERIODO','=',  $datos->mes)
                    ->where('ANIO','=', $datos->anio)
                    ->get();
        return response()->json([$agenfac],200);
    }

    public function store(Request $facturacion)
    {
        agenfac::create($facturacion->all());
    }
    public function liquidacionPDF(Request $request){
        $agenfac = DB::table('agenfac')
                    ->where('PERIODO','=',  $datos->mes)
                    ->where('ANIO','=', $datos->anio)
                    ->where('HOSPITAL','=',$datos->hospital)
                    ->get();
    }
}
