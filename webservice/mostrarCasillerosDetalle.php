<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Casilleros.php";
    $Casilleros = new Casilleros();
    $Casilleros->ConstructorDetalle(@$_POST['idCasillero'], @$_POST['descripcion']);
    echo json_encode($Casilleros->obtenerCasilleroDetalle($conexion));
}