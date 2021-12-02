<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Cliente.php";

    $Clientes = new Cliente();
    $Clientes->constructorTotal(@$_POST['total']);
    echo json_encode($Clientes->totalClientes($conexion));
}
?>