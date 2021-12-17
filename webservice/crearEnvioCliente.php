<?php

if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Envio.php");

    $Envio = new Envio();
    $Envio->constructorIdPaquete(@$_POST['idPaquete']);
    echo json_encode($Envio->crearEnvioCliente($conexion));

}
?>