<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Empleado.php";

    $Empleados = new Empleado();
    $Empleados->constructorEditar(@$_POST['idEmpleado'], @$_POST['nombre'], @$_POST['direccion'], @$_POST['jornada'], @$_POST['cargo']);
    echo json_encode($Empleados->obtenerEmpleados($conexion));
}