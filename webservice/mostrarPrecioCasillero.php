<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/PrecioCasillero.php";

    $Clientes = new precioCasillero();
    //$Clientes->constructorListar(@$_POST['idCliente'], @$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['estado']);
    echo json_encode($Clientes->obtenerPrecios($conexion,@$_POST['valor']));
}
?>