<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $cliente = new Cliente();

    $cliente->constructorSobrecargado(@$_POST['nombre'],@$_POST['telefono'],@$_POST['direccion']); 
    echo json_encode($cliente->registrarCliente($conexion)); 
}
?>