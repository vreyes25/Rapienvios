<?php

require "../php/conexion.php";
require "PlantillaEmpleado.php";
Session_start();
if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
    header('Location:loginAdmin.php');
  }

    $sql = "SELECT envio.idEnvio, envio.idPaquete, paquete.descripcion, cliente.nombre, cliente.direccion, cliente.telefono, tracking.ubicacion FROM envio,paquete,cliente,casillero,tracking WHERE envio.idPaquete=paquete.idPaquete AND paquete.idCasillero = casillero.idCasillero AND casillero.idCasillero = cliente.idCasillero AND paquete.idPaquete = tracking.idPaquete AND tracking.fechaSalida='0000-00-00' ORDER BY envio.idEnvio";
    
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
    $pdf->Cell(30, 5,  utf8_decode("ID Paquete"), 1, 0, "C");

    $pdf->Cell(60, 5,  utf8_decode("Descripcion"), 1, 0, "C");
    $pdf->Cell(35, 5,  utf8_decode("cliente"), 1, 0, "C");
    //$pdf->Cell(30, 5,  utf8_decode("direccion"), 1, 0, "C");
    $pdf->SetFont("Arial", "B", 9);
    $pdf->Cell(25, 5,  utf8_decode("telefono"), 1, 0, "C");
    $pdf->Cell(45, 5,  utf8_decode("ubicacion Actual"), 1, 1, "C");
    $pdf->SetFont("Arial", "", 9);
   
    while ( $fila = mysqli_fetch_array($resultado)) {
        $pdf->SetTextColor(0,0,0);
        //$pdf->Cell(19, 5, $idventa, 1, 0, "C");
        $pdf->Cell(19, 5, $fila['idEnvio'], 1, 0, "C");
        $pdf->Cell(30, 5, utf8_decode($fila['idPaquete']), 1, 0, "C"); 
        $pdf->Cell(60, 5, utf8_decode($fila['descripcion']), 1, 0, "C"); 
        $pdf->Cell(35, 5, $fila['nombre'], 1, 0, "C"); 
        $pdf->Cell(25, 5, $fila['telefono'], 1, 0, "C");  
        $pdf->Cell(45, 5, $fila['ubicacion'], 1, 1, "C"); 
}



$pdf->Output('ReporteEnvios'.date('d/m/Y g:i:s a').'.pdf','i');


?>