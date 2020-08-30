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
        
        return response()->json($incisos,200);
    }
    public function update(Request $datos)
    {
        $inciso = inciso::find($datos->id);
        $inciso->valor = $datos->valor;
        $inciso->save();

        return response()->json(['inciso modificado correctamente'], 204);

    }
    public function create(Request $datos)
    {
        inciso::create($datos->all());

        return response()->json(['inciso creado correctamente'], 204);

    }
    public function delete($id)
    {
        $delete = inciso::where('id',$id)->delete();
        //$delete = inciso::where('id',$id)->delete();
        return response()->json(['Borrado Correctamente'],204);
    }
}
