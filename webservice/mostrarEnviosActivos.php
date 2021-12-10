<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";

    $Empleados = new Envio();
    //$Empleados->constructorEditar(@$_POST['idEmpleado'], @$_POST['nombre'], @$_POST['direccion'], @$_POST['jornada'], @$_POST['cargo'],@$_POST['correo']);
    echo json_encode($Empleados->obtenerEnviosPendientes($conexion,@$_POST['valor']));
}