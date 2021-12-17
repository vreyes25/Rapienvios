<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";

    $casillero = @$_POST['casillero'];
    $envio = new Envio();
    $envio->constructorEnviosCliente(@$_POST['idEnvio'], @$_POST['descripcion'], @$_POST['fechaRecibido'], @$_POST['fechaEnvio']);
    echo json_encode($envio->obtenerEnviosByCasillero($conexion,$casillero));
}