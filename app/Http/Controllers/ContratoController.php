<?php

namespace App\Http\Controllers;

use App\contrato;
use Illuminate\Http\Request;
use Maatwebsite\Excel\facades\Excel;
use App\imports\contratoImport;
use DB;
use Carbon;
class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrato = contrato::all();
        return $contrato;
    }

   

    public function importExcel(Request $request)
    {
        $file = $request->file('files');
        Excel::import(new contratoImport,$file);
    }
    public function vistaExcel()
    {
        return view('importContrato');
    }
    public function activos(Request $request)
    {
        $mytime = \Carbon\Carbon::now();
        $mytime = $mytime->format('Y-m-d');
        
        $contrato = DB::table('contratos')
                        ->join('proveedors','proveedor_id','=','proveedors.id')
                        ->join('especialidad','especialidad_id','=','especialidad.id')
                        ->select('proveedors.id','proveedors.proveedor','proveedors.dni','proveedors.cuil',
                        'proveedors.nombre','proveedors.apellido','contratos.contrato',
                        'especialidad.especialidad','contratos.fecha_fin')
                        ->where('fecha_fin','>=',$mytime)
                        ->get();
        
        return $contrato;
    }
    public function bajas(Request $request)
    {
        $mytime = \Carbon\Carbon::now();
        $mytime = $mytime->format('Y-m-d');
        
        $contrato = DB::table('proveedors')
                        ->leftJoin('contratos','proveedor_id','=','proveedors.id')
                        ->select('proveedors.id','proveedors.proveedor','proveedors.dni','proveedors.cuil',
                        'proveedors.nombre','proveedors.apellido','contratos.contrato','contratos.fecha_fin')
                        ->whereNull('contratos.contrato')
                        ->orWhere('fecha_fin','<=',$mytime)
                        ->get();
        
        return $contrato;
    }
    public function store(Request $proveedor)
    {
        
    }

    
}
