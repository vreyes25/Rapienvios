<?php

require "../php/conexion.php";
require "PlantillaCliente.php";
Session_start();
if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
    header('Location:loginAdmin.php');
  }

    $sql = "SELECT `idCliente`, `nombre`, `telefono`, `direccion`, estados.estado, `correo`, `idCasillero` FROM `cliente`, estados where cliente.idEstado = estados.idEstado";
    
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
    $pdf->Cell(60, 5,  utf8_decode("Nombre"), 1, 0, "C");

    $pdf->Cell(25, 5,  utf8_decode("Telefono"), 1, 0, "C");
    $pdf->Cell(60, 5,  utf8_decode("Direccion"), 1, 0, "C");
    $pdf->Cell(20, 5,  utf8_decode("Estado"), 1, 0, "C");
    $pdf->Cell(50, 5,  utf8_decode("Correo"), 1, 0, "C");
    $pdf->Cell(25, 5,  utf8_decode("#Casillero"), 1, 1, "C");
    $pdf->SetFont("Arial", "B", 9);
    //$pdf->Cell(45, 5,  utf8_decode("Correo"), 1, 1, "C");
    
    $pdf->SetFont("Arial", "", 9);
   
    while ( $fila = mysqli_fetch_array($resultado)) {
        $pdf->SetTextColor(0,0,0);
        //$pdf->Cell(19, 5, $idventa, 1, 0, "C");
        $pdf->Cell(19, 5, $fila['idCliente'], 1, 0, "C");
        $pdf->Cell(60, 5, utf8_decode($fila['nombre']), 1, 0, "C"); 
        $pdf->Cell(25, 5, utf8_decode($fila['telefono']), 1, 0, "C"); 
        $pdf->Cell(60, 5, $fila['direccion'], 1, 0, "C"); 
        $pdf->Cell(20, 5, $fila['estado'], 1, 0, "C");  
        $pdf->Cell(50, 5, $fila['correo'], 1, 0, "C");  
        $pdf->Cell(25, 5, $fila['idCasillero'], 1, 1, "C");  
        //$pdf->Cell(45, 5, $fila['correo'], 1, 1, "C"); 
}



$pdf->Output('ReporteCliente'.date('d/m/Y g:i:s a').'.pdf','d');


?>