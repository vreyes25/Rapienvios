<?php

require "../php/conexion.php";
require "PlantillaPrecioEnvio.php";
Session_start();
if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
    header('Location:loginAdmin.php');
  }

    $sql = "SELECT `idPaquete`, `descripcion`, `peso`, `idCasillero` FROM `paquete`";
    
    $resultado = mysqli_query($conexion,$sql);
    //$conexion->query($sql);

    $pdf = new PDF("L", "mm", "letter");
    //$pdf->setFillColor(128,0,0);
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 12);
    $pdf->SetTextColor(0,0,0);
    //$pdf->Cell(19, 5, "Id", 1, 0, "C");
    
    //$pdf->SetDrawColor(128,0,0);
    $pdf->Cell(19, 5, utf8_decode("ID"), 1, 0, "C");
    $pdf->Cell(100, 5,  utf8_decode("Descripción"), 1, 0, "C");

    $pdf->Cell(60, 5,  utf8_decode("Peso"), 1, 0, "C");
    $pdf->Cell(25, 5,  utf8_decode("#Casillero"), 1, 1, "C");
    //$pdf->Cell(30, 5,  utf8_decode("Precio"), 1, 1, "C");
    $pdf->SetFont("Arial", "B", 9);
    //$pdf->Cell(45, 5,  utf8_decode("Correo"), 1, 1, "C");
    
    $pdf->SetFont("Arial", "", 9);
   
    while ( $fila = mysqli_fetch_array($resultado)) {
        $pdf->SetTextColor(0,0,0);
        //$pdf->Cell(19, 5, $idventa, 1, 0, "C");
        $pdf->Cell(19, 5, $fila['idPaquete'], 1, 0, "C");
        $pdf->Cell(100, 5, utf8_decode($fila['descripcion']), 1, 0, "C"); 
        $pdf->Cell(60, 5, utf8_decode($fila['peso']), 1, 0, "C"); 
        $pdf->Cell(25, 5, $fila['idCasillero'], 1, 1, "C"); 
        //$pdf->Cell(30, 5, $fila['precio'], 1, 1, "C");  
        //$pdf->Cell(45, 5, $fila['correo'], 1, 1, "C"); 
}



$pdf->Output('ReportePaquete'.date('d/m/Y g:i:s a').'.pdf','d');


?>