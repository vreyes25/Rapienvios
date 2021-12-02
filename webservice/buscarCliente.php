<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Cliente.php";

    $Clientes = new Cliente();
    $Clientes->constructorReporte(@$_POST['idCliente'], @$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['estado']);
    echo json_encode($Clientes->buscarCliente($conexion));
}
?>