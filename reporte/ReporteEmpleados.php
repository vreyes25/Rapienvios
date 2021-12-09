<?php

require "../php/conexion.php";
require "PlantillaEmpleado.php";
Session_start();
if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
    header('Location:loginAdmin.php');
  }

    $sql = "SELECT E.idEmpleado, E.nombre, E.direccion, J.descripcion AS jornada, C.descripcion AS cargo
    , correo FROM empleado AS E
    INNER JOIN jornadas AS J ON E.idJornada = J.idJornada
    INNER JOIN cargo AS C ON E.idCargo = C.idCargo";
    
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
    $pdf->Cell(35, 5,  utf8_decode("Nombre"), 1, 0, "C");

    $pdf->Cell(60, 5,  utf8_decode("Dirección"), 1, 0, "C");
    $pdf->Cell(22, 5,  utf8_decode("Jornada"), 1, 0, "C");
    $pdf->Cell(30, 5,  utf8_decode("Cargo"), 1, 0, "C");
    $pdf->SetFont("Arial", "B", 9);
    $pdf->Cell(45, 5,  utf8_decode("Correo"), 1, 1, "C");
    
    $pdf->SetFont("Arial", "", 9);
   
    while ( $fila = mysqli_fetch_array($resultado)) {
        $pdf->SetTextColor(0,0,0);
        //$pdf->Cell(19, 5, $idventa, 1, 0, "C");
        $pdf->Cell(19, 5, $fila['idEmpleado'], 1, 0, "C");
        $pdf->Cell(35, 5, utf8_decode($fila['nombre']), 1, 0, "C"); 
        $pdf->Cell(60, 5, utf8_decode($fila['direccion']), 1, 0, "C"); 
        $pdf->Cell(22, 5, $fila['jornada'], 1, 0, "C"); 
        $pdf->Cell(30, 5, $fila['cargo'], 1, 0, "C");  
        $pdf->Cell(45, 5, $fila['correo'], 1, 1, "C"); 
}



$pdf->Output('ReporteEmpleados'.date('d/m/Y g:i:s a').'.pdf','d');


?>