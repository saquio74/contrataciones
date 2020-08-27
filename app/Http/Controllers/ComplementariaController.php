<?php

namespace App\Http\Controllers;

use App\complementaria;
use Illuminate\Http\Request;
use DB;
use App\pdf;

class ComplementariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complementaria = complementaria::all();

        return response()->json($complementaria,200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'leg'           => 'required',
            'periodo'       => 'required',
            'anio'          => 'required',
            'horas'         => 'required',
            'inciso'        => 'required',
            'bonificacion'  => 'required',
            'subtot'        => 'required',
            'bonvalor'      => 'required',
            'total'         => 'required',
            'hospital'      => 'required',
            'fecha'         => 'required',
            
        ]);
        complementaria::create($request->all());
        
        return response()->json(['guardado correctamente'],204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\complementaria  $complementaria
     * @return \Illuminate\Http\Response
     */
    public function getComplementaria(Request $complementaria)
    {
        $complementaria = DB::table('complementaria')
                                ->select('agente.legajo','periodo','anio','horas','inciso.inciso','bonificacion','subtot','bonvalor','total','hospitales.hospital')
                                ->join('agentes','complementaria.leg','=','agente.legajo')
                                ->join('hospitales','complementaria.hospital','=','hospitales.id')
                                ->join('inciso','complementaria.inciso','=','inciso.id')
                                ->where('hospitales.id','=',$complementaria->hospital_id)
                                ->where('fecha','=',$complementaria->fecha)
                                ->get();

        return response()->json($complementaria,200);
    }
    public function complementariaPDF(Request $datos)
    {
        $complementaria = DB::table('complementaria')
                                ->select('agente.legajo','periodo','anio','horas','inciso.inciso','bonificacion','subtot','bonvalor','total','hospitales.hospital')
                                ->join('agentes','complementaria.leg','=','agente.legajo')
                                ->join('hospitales','complementaria.hospital','=','hospitales.id')
                                ->join('inciso','complementaria.inciso','=','inciso.id')
                                ->where('hospitales.id','=',$datos->hospital_id)
                                ->where('fecha','=',$datos->fecha)
                                ->where('periodo','=',$datos->periodo)
                                ->where('anio','=',$datos->anio)
                                ->get();
        $pdf = new pdf;
        setlocale(LC_MONETARY, 'it_IT');
            
        $pdf->SetFont('Arial','B',16);
        $pdf->AddPage();
        $pdf->SetXY(30, 60);
        $pdf->MultiCell(150, 7, utf8_decode('Liquidacion Complementaria Mensual'),0,'C');
        $pdf->MultiCell(190, 7, utf8_decode('M.T. '.$datos->periodo.' '.$datos->anio),0,'C');
        $pdf->MultiCell(190, 7, utf8_decode($datos->hospital),0,'C');

        $pdf->Ln();
                   
        $pdf->SetFont('Arial','B',18);
        $pdf->MultiCell(60, 7, utf8_decode($sector),0,'L');
        $pdf->SetFont('Arial','B',12);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,5,"Legajo",1);
        $pdf->Cell(12,5,"Inc",1);
        $pdf->Cell(70,5,"Apellido y nombre",1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,5,"Tot. Hs.",1);
        $pdf->Cell(20,5,"Importe",1);
        $pdf->Cell(15,5,"% Bon.",1);
        $pdf->Cell(20,5,"Bon.",1);
        $pdf->Cell(20,5,"Total",1);

    
        $horas=0;
        $total=0;
        $agenteAux = 0;
        $cantidad= 0;
        foreach($agente as $complementaria){
            if($agenteAux != $agente->LEGAJO){
                $cantidad++;
            }

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(20,5,$agente->LEGAJO,1);
            $pdf->Cell(12,5,$agente->INCISO,1);
            $pdf->Cell(70,5,$agente->NOMBRE,1);
            $pdf->Cell(15,5,$agente->HORAS,1);
            $pdf->Cell(20,5,"$".number_format(round($agente->SUBTOT,2), 2, ",", "."),1);
            $pdf->Cell(15,5,$agente->BONIFICACION.'%',1);
            $pdf->Cell(20,5,"$".number_format(round($agente->BONVALOR,2), 2, ",", "."),1);
            $pdf->Cell(20,5,"$".number_format(round($agente->TOTAL,2), 2, ",", "."),1);

            $horas += $agente->HORAS;
            $total += $agente->TOTAL;
            $agenteAux = $agente->LEGAJO; 
                
        }

        
        $pdf->ln();
        $pdf->Ln();
        $pdf->SetFont('Arial','B',10);
        $pdf->MultiCell(80, 7, utf8_decode("Total de agentes ".number_format($cantidad, 0, ",", ".")),0,'L');
        $pdf->MultiCell(80, 7, utf8_decode("Total Con Bonificacion $".number_format($total, 2, ",", ".")),0,'L');

        $response = response($pdf->Output('D'));
        $response->header('Content-Type', 'application/pdf');
        $file= public_path(). "/download/info.pdf";

        return response()->download($file,'nombre',$response);
        
    }


    public function destroy(Request $complementaria)
    {
        complementaria::where('id',$complementaria->id)->delete();

        return response()->json(['Borrado Correctamente'],204);
    }
}
