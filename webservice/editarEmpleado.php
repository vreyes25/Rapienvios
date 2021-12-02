<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $Empleado = new Empleado();

    $Empleado->constructorEditar(@$_POST['idEmpleado'], @$_POST['nombre'], @$_POST['direccion'], @$_POST['idJornada'], @$_POST['idCargo']); 
    echo json_encode($Empleado->editarEmpleado($conexion)); 
}