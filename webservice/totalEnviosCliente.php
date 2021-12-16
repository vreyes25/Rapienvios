<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";

    $casillero = @$_POST['casillero'];
    $Envio = new Envio();
    $Envio->constructorTotal(@$_POST['total']);
    echo json_encode($Envio->totalEnviosCliente($conexion, $casillero));
}