<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agenfac;
use App\pdf;
use App\Exports\AgenfacExport;
use Maatwebsite\Excel\facades\Excel;
Use DB;
class agenfacs extends Controller
{
    
    public function index()
    {
        $agenfac = agenfac::all();
        return $agenfac;
    }

    public function getFacturacion()
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
    public function getPeriodo()
    {
        $periodo = DB::table('agenfac')
                    ->distinct()
                    ->select('periodo','anio')
                    ->get();
        return response()->json([$periodo],200);
    }
    
    public function liquidacionPDF(Request $datos){
        $hospital = $datos->hospital;
        $periodo = $datos->periodo;
        $anio   = $datos->anio;
        $agenfac = DB::table('agenfac')
                    ->join('agentes','agenfac.leg','=','agentes.legajo')
                    ->join('inciso','agenfac.inc','=','inciso.id')
                    ->join('servicio','agentes.idservicio','=','servicio.id')
                    ->join('sector','agentes.sec','=','sector.id')
                    ->where('PERIODO','=', $periodo)
                    ->where('ANIO','=', $anio)
                    ->where('HOSPITAL','=',$datos->hospital_id)
                    ->orderBy('servicio.id')
                    ->orderBy('sector.id')
                    ->orderBy('agentes.legajo')
                    ->get();

                    
            $pdf = new pdf;
            setlocale(LC_MONETARY, 'it_IT');
            
            $pdf->SetFont('Arial','B',16);
            $pdf->AddPage();
            $pdf->SetXY(30, 60);
            $pdf->MultiCell(150, 7, utf8_decode('Liquidacion Mensual'),0,'C');
            $pdf->MultiCell(190, 7, utf8_decode('M.T. '.$periodo.' '.$anio),0,'C');
            $pdf->MultiCell(190, 7, utf8_decode($hospital),0,'C');

            $cont=0;
            $cont2=0;
            $agen=0;
            $horas=0;
            $total=0;
            $agenteAux = '';
            $bandera = 0;
            $totFin=0;
            $cantAgentes=0;
            foreach ($agenfac as &$agente) {
                $servicio;
                $sector;
                if($cont ==0){
                    $servicio = $agente->SERVICIO;
                    $pdf->SetFont('Arial','B',18);
                    $pdf->MultiCell(60, 7, utf8_decode($servicio),0,'L');

                    
                    $cont++;
                }elseif ($servicio != $agente->SERVICIO) {
                    
                    $pdf->ln();
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
                    $pdf->Cell(70, 7, utf8_decode("Cantidad de agentes del sector"),0,'L');
                    $pdf->Cell(70, 7, utf8_decode($agen),0,'L');
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
                    $pdf->Cell(70, 7, utf8_decode("Total Servicio "),0,'L');
                    $pdf->Cell(80, 7, utf8_decode("Cantidad de Horas ".number_format($horas, 0, ",", ".")),0,'L');
                    $pdf->Cell(50, 7, utf8_decode(" Total Servicio $".number_format($total, 2, ",", ".")),0,'L');
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');

                    $servicio = $agente->SERVICIO;
                    $pdf->Ln();
                    $pdf->SetFont('Arial','B',18);
                    $pdf->MultiCell(60, 7, utf8_decode($servicio),0,'L');
                    $bandera = 1;
                    $sector = $agente->SECTOR;
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
                }
                if($bandera == 1){
                    $bandera = 0;
                    $agen = 0;
                    $total = 0;
                    
                }elseif ($cont2 == 0) {
                    $cont2++;
                    $sector = $agente->SECTOR;
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
                } elseif($sector != $agente->SECTOR ) {
                    $pdf->ln();
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
                    $pdf->Cell(70, 7, utf8_decode("Cantidad de agentes del sector"),0,'L');
                    $pdf->Cell(70, 7, utf8_decode($agen),0,'L');
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
                    $pdf->Cell(70, 7, utf8_decode("Total Servicio "),0,'L');
                    $pdf->Cell(80, 7, utf8_decode("Cantidad de Horas ".number_format($horas, 0, ",", ".")),0,'L');
                    $pdf->Cell(50, 7, utf8_decode(" Total Servicio $".number_format($total, 2, ",", ".")),0,'L');
                    $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
                    $agen = 0;
                    $total = 0;
                    
                    $sector = $agente->SECTOR;
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
                }
                
                $pdf->Ln();
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(20,5,$agente->LEGAJO,1);
                $pdf->Cell(12,5,$agente->INCISO,1);
                $pdf->Cell(70,5,$agente->NOMBRE,1);
                $pdf->Cell(15,5,$agente->HORAS,1);
                $pdf->Cell(20,5,"$".number_format(round($agente->SUBTOT,2), 2, ",", "."),1);
                $pdf->Cell(15,5,$agente->BONIFICACION.'%',1);
                $pdf->Cell(20,5,"$".number_format(round($agente->BONVALOR,2), 2, ",", "."),1);
                $pdf->Cell(20,5,"$".number_format(round($agente->TOTAL,2), 2, ",", "."),1);
                
                if($agenteAux != $agente->LEGAJO){

                    $agen++;
                    $cantAgentes++;
                }
                $agenteAux = $agente->LEGAJO;
                $horas += $agente->HORAS;
                $total += $agente->TOTAL;
                $totFin += $agente->TOTAL;
                
            }
            $pdf->ln();
            $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
            $pdf->Cell(70, 7, utf8_decode("Cantidad de agentes del sector"),0,'L');
            $pdf->Cell(70, 7, utf8_decode($agen),0,'L');
            $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');
            $pdf->Cell(70, 7, utf8_decode("Total Servicio "),0,'L');
            $pdf->Cell(80, 7, utf8_decode("Cantidad de Horas ".number_format($horas, 0, ",", ".")),0,'L');
            $pdf->Cell(50, 7, utf8_decode(" Total Servicio $".number_format($total, 2, ",", ".")),0,'L');
            $pdf->MultiCell(50, 7, utf8_decode("      "),0,'L');

            $pdf->ln();
            $pdf->Ln();
            $pdf->SetFont('Arial','B',10);
            $pdf->MultiCell(80, 7, utf8_decode("Total de agentes ".number_format($cantAgentes, 0, ",", ".")),0,'L');
            $pdf->MultiCell(80, 7, utf8_decode("Total Con Bonificacion $".number_format($totFin, 2, ",", ".")),0,'L');

            $response = response($pdf->Output('D'));
            $response->header('Content-Type', 'application/pdf');
            $file= public_path(). "/download/info.pdf";

            return response()->download($file,'nombre',$response);


        
    }
    public function excelLiquidacion(Request $datos){
        return Excel::download(new AgenfacExport($datos), 'hospital'.$datos->hospital.'.xlsx');
    }
    public function getModificar(Request $datos){
        $agenfac = DB::table('agenfac')
                    ->select('agenfac.id','leg','agentes.nombre','inciso.inciso','subtot','bonvalor','total','sector.sector')
                    ->join('agentes','agenfac.leg','=','agentes.legajo')
                    ->join('inciso','agenfac.inc','=','inciso.id')
                    ->join('servicio','agentes.idservicio','=','servicio.id')
                    ->join('sector','agentes.sec','=','sector.id')
                    ->where('PERIODO','=', $datos->periodo)
                    ->where('ANIO','=', $datos->anio)
                    ->where('HOSPITAL','=', $datos->hospital_id)

                    ->orderBy('agentes.legajo')
                    ->get();
        return response()->json([$agenfac],200);
    }
    public function delete($id)
    {
        $delete = agenfac::where('id',$id)->delete();
    }

}
