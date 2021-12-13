<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $Cliente = new Cliente();

    $Cliente->constructorEditar(@$_POST['idCliente'], @$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion']); 
    echo json_encode($Cliente->editarCliente($conexion)); 
}
?>