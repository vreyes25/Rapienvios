<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Paquetes.php";
    
    
    $casillero = @$_POST['casillero'];
    $Paquete = new Paquete();
    $Paquete->constructorEditar(@$_POST['idPaquete'], @$_POST['descripcion'], @$_POST['peso'], $casillero);
    echo json_encode($Paquete->obtenerPaquetesByCasillero($conexion));
}
?>