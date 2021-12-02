<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Paquete.php");
    $Empleado = new Paquete();

    $Empleado->constructorPaqueteRegistrar(@$_POST['descripcion'], @$_POST['peso'], @$_POST['casillero']); 
    echo json_encode($Empleado->registrarPaquete($conexion)); 
}