<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Paquetes.php";

    $casillero = @$_POST['casillero'];
    $Paquetes = new Paquete();
    $Paquetes->constructorTotalClientes(@$_POST['total'], $casillero);
    echo json_encode($Paquetes->totalPaquetesCliente($conexion));
}