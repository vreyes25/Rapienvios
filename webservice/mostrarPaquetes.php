<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Paquetes.php";

    $Paquete = new Paquete();
    $Paquete->constructorEditar(@$_POST['idPaquete'], @$_POST['descripcion'], @$_POST['peso'], @$_POST['idCasillero']);
    echo json_encode($Paquete->obtenerPaquetes($conexion,@$_POST['valor']));
}
?>