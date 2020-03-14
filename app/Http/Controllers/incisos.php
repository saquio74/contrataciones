<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inciso;
class incisos extends Controller
{
    public function index()
    {
        //$hospitales = \DB::table('hospitales')->select('hospital')->get();
        $incisos = inciso::all();
        $incisos = json_encode($incisos);
        return $incisos;
    }
}
