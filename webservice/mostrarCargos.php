<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Cargos.php";
    $Cargos = new Cargos();
    $Cargos->ConstructorPorDefecto(@$_POST['idCargo'], @$_POST['descripcion']);
    echo json_encode($Cargos->obtenerCargos($conexion));
}