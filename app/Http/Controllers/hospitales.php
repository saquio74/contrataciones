<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hospital;
use App\agente;
class hospitales extends Controller
{
    public function index()
    {
        //$hospitales = \DB::table('hospitales')->select('hospital')->get();
        $hospitales = hospital::all();
        //$hospitales = json_encode($hospitales);
        return $hospitales;
    }
    public function show($id)
    {
        
        $hospitales = hospital::where('id',$id)->get();
        
        //$hospitales = hospitales::find('ID');

        //$hospitales = json_encode($hospitales);
        return response()->json($hospitales,200);
        
        
    }
    
    
    
    
}
