<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Cliente.php";
    $ClienteBuscado = new Cliente();
    $ClienteBuscado->idCliente = @$_POST['idCliente'];
    echo json_encode($ClienteBuscado->eliminarCliente($conexion));
}
?>