<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/trackings.php";
    $Clientes = new Tracking();
    //$Clientes->constructorData(@$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['correo'], @$_POST['idCasillero']);
    echo json_encode($Clientes->obtenerTrackingPorPaquete($conexion,@$_POST['idCliente']));
}