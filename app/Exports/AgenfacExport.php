<?php

namespace App\Exports;

use App\agenfac;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class AgenfacExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($datos){
        $this->periodo      = $datos->periodo;
        $this->anio         = $datos->anio;
        $this->hospital_id  = $datos->hospital_id;
        
    }
    public function headings(): array
    {
        return [
            'LEGAJO',
            'INCISO',
            'NOMBRE',
            'SUBTOTAL',
            'BONIFICACION',
            'TOTAL',
            'SECTOR/SERVICIO'
        ];
    }
    public function collection()
    {
        
        $agenfac = DB::table('agenfac')
                    ->select('leg','agentes.nombre','inciso.inciso','subtot','bonvalor','total','sector.sector')
                    ->join('agentes','agenfac.leg','=','agentes.legajo')
                    ->join('inciso','agenfac.inc','=','inciso.id')
                    ->join('servicio','agentes.idservicio','=','servicio.id')
                    ->join('sector','agentes.sec','=','sector.id')
                    ->where('PERIODO','=', $this->periodo)
                    ->where('ANIO','=', $this->anio)
                    ->where('HOSPITAL','=', $this->hospital_id)

                    ->orderBy('agentes.legajo')
                    ->get();
        return $agenfac;
        //return agenfac::all();
    }
}
