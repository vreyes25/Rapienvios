<?php
require 'fpdf/fpdf.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image("../img/Logo2.png", 15, 10, 26);
        // Arial bold 15
       
        // Título
        $this->SetFont("Arial", "B", 10);
        $this->Cell(20);
        $this->Cell(25, 5, utf8_decode(""), 0, 1, "C");
   
        $this->SetFont("Arial", "B", 10);
        $this->Cell(20);
        $this->Cell(25, 5, utf8_decode(""), 0, 1, "C");
   


        $this->SetFont("Arial", "B", 10);
        $this->Cell(20);
        $this->Cell(25, 5, utf8_decode("RapiEnvios"), 0, 0, "C");
   
        //Setear el horario
        date_default_timezone_set('America/Tegucigalpa');

        $this->SetFont("Arial", "", 10);
        $this->Cell(100);
        $this->Cell(25, 5, "Fecha: ". date('d/m/Y g:i:s a'), 0, 1, "C");
        
   
        $this->Ln(2);
        $this->Cell(23);
        $this->Cell(25, 5, utf8_decode("Teléfono: 2772-0012"), 0, 0, "C");
        
        $this->Cell(100);
        $this->Cell(20, 5, utf8_decode("Direccion: Tegucigalpa, M.D.C."), 0, 0, "C");
        //Fecha
        $this->Ln(10);
        $this->SetFont("Arial", "B", 12);
        $this->Cell(25);
        $this->Cell(140, 5, utf8_decode("Reporte de Empleados"), 0, 0, "C");
        // Salto de línea
        $this->Ln(10);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final

    
        
        // Arial italic 8
        $this->SetY(-15);
        $this->Ln(1);
        $this->Cell(20, 5, utf8_decode('"En Dios confiamos"'), 0, 0, "C");
        $this->SetFont('Arial', 'I', 8);
        
        // Número de página
        $this->Ln(-2);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    
    }
}
?>