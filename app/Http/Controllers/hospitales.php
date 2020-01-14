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
        return view('hospitales.hospitales', compact('hospitales'));
    }
    public function show($id)
    {
        
        $hospitales = hospital::where('id',$id)->get();
        
        //$hospitales = hospitales::find('ID');
        
        if($hospitales->isEmpty()){
            return view('hospitales.show');
        }else{
            return view('hospitales.show', compact('hospitales'));
        }
        
    }
    
    
    
    
}
