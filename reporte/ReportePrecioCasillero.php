<?php

require "../php/conexion.php";
require "PlantillaPrecioEnvio.php";
Session_start();
if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
    header('Location:loginAdmin.php');
  }

    $sql = "SELECT idHistorial, tamanio.descripcion, fechaInicio, fechaFinal, precio from historialpreciocasillero, tamanio where historialpreciocasillero.idCasillero=tamanio.idTamanio order by descripcion";
    
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
    $pdf->Cell(35, 5,  utf8_decode("Casillero"), 1, 0, "C");

    $pdf->Cell(60, 5,  utf8_decode("fecha de Inicio"), 1, 0, "C");
    $pdf->Cell(60, 5,  utf8_decode("Fecha de Finalización"), 1, 0, "C");
    $pdf->Cell(30, 5,  utf8_decode("Precio"), 1, 1, "C");
    $pdf->SetFont("Arial", "B", 9);
    //$pdf->Cell(45, 5,  utf8_decode("Correo"), 1, 1, "C");
    
    $pdf->SetFont("Arial", "", 9);
   
    while ( $fila = mysqli_fetch_array($resultado)) {
        $pdf->SetTextColor(0,0,0);
        //$pdf->Cell(19, 5, $idventa, 1, 0, "C");
        $pdf->Cell(19, 5, $fila['idHistorial'], 1, 0, "C");
        $pdf->Cell(35, 5, utf8_decode($fila['descripcion']), 1, 0, "C"); 
        $pdf->Cell(60, 5, utf8_decode($fila['fechaInicio']), 1, 0, "C"); 
        $pdf->Cell(60, 5, $fila['fechaFinal'], 1, 0, "C"); 
        $pdf->Cell(30, 5, $fila['precio'], 1, 1, "C");  
        //$pdf->Cell(45, 5, $fila['correo'], 1, 1, "C"); 
}



$pdf->Output('ReportePreciosCasilleros'.date('d/m/Y g:i:s a').'.pdf','d');


?>