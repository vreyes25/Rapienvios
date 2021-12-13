<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Jornadas.php";
    $Jornadas = new Jornada();
    $Jornadas->ConstructorPorDefecto(@$_POST['idJornada'], @$_POST['descripcion']);
    echo json_encode($Jornadas->obtenerJornadas($conexion));
}