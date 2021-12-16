<?php

if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Paquetes.php");

    $Paquete = new Paquete();
    $Paquete->constructorIdPaquete(@$_POST['idPaquete']); 
    echo json_encode($Paquete->enviarPaqueteCliente($conexion)); 
}
?>