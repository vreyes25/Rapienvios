<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $Empleado = new Empleado();

    $Empleado->constructorSobrecargado(@$_POST['nombre'], @$_POST['direccion'], @$_POST['jornada'], @$_POST['cargo']); 
    echo json_encode($Empleado->registrarEmpleado($conexion)); 
}