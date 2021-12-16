<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/tamanio.php";
    $Jornadas = new Tamanio();
    //$Jornadas->ConstructorPorDefecto(@$_POST['idJornada'], @$_POST['descripcion']);
    echo json_encode($Jornadas->obtenerTamanio($conexion));
}