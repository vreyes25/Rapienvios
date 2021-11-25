<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $cliente = new Cliente();

    $cliente->constructorSobrecargado(@$_POST['nombre'],@$_POST['telefono'],@$_POST['direccion']);
    
    //$Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    //$cliente->ConstructorLogin(@$_POST['usuario'], $contra); 
    echo json_encode($cliente->registrarCliente($conexion)); 
}
?>