<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Empleado.php";

    $Empleados = new Empleado();
    $Empleados->constructorEditar(@$_POST['idEmpleado'], @$_POST['nombre'], @$_POST['direccion'], @$_POST['idJornada'], @$_POST['idCargo']);
    echo json_encode($Empleados->buscarEmpleado($conexion));
}