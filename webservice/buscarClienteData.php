<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Cliente.php";
    $Clientes = new Cliente();
    $Clientes->constructorData(@$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['correo'], @$_POST['idCasillero']);
    echo json_encode($Clientes->buscarClienteInfo($conexion));
}