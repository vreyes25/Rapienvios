<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/ClaseAuxiliar.php";

    
    $envio = new Auxiliar();
    $envio->idPaquete = @$_POST['idPaquete'];
    //$envio->constructorEnviosCliente(@$_POST['idEnvio'], @$_POST['descripcion'], @$_POST['fechaRecibido'], @$_POST['fechaEnvio'], $casillero);
    echo json_encode($envio->mostrarInfoEnvio($conexion));
}