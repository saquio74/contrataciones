<?php
namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf extends Fpdf
{
    public function Header()
    {
        $this->Image(public_path() . '\img\logo.png',10,6,30);
        $this->Ln(20);
        $this->SetFont('Arial','B',20);
        $title = 'Municipalidad de Malvinas Argentinas';
        $subtitle = 'Av. PTE Juan Domingo Peron 4276';
        $w = $this->GetStringWidth($title)+6;
        $y = $this->GetStringWidth($subtitle)+6;
        $this->SetX((210-$w)/2);
        
        $this->Cell($w,9,$title,0,0,'C');
        $this->Ln(10);
        $this->SetX((210-$y)/2);
        $this->Cell($y,9,$subtitle,0,0,'C');
        $this->Ln(15);
        //$this->Cell(0,0,'Av. PTE Juan Domingo Peron 4276',0,0);
    }

    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->AliasNbPages('{totalPages}'); 
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{totalPages}',0,0,'C');
    }
}

