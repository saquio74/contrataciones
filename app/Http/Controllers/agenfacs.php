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
        $agenfac = json_encode($agenfac);
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
    }

    public function store(Request $facturacion)
    {
        agenfac::create($facturacion->all());
    }
}
