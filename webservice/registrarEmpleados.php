<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $Empleado = new Empleado();

    $contrasena = @$_POST['contrasena'];
    $Encriptar = password_hash($contrasena,PASSWORD_DEFAULT);


    $Empleado->constructorSobrecargado(@$_POST['nombre'], @$_POST['direccion'], @$_POST['jornada'], @$_POST['cargo'],@$_POST['correo'],$Encriptar); 
    echo json_encode($Empleado->registrarEmpleado($conexion)); 
}