<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $Cliente = new Cliente();

    $Cliente->constructorEditarData(@$_POST['correo'], @$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['idCasillero']); 
    echo json_encode($Cliente->editarClienteData($conexion)); 
}