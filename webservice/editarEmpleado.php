<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $Empleado = new Empleado();

    $contrasena = @$_POST['contrasena'];
    $Encriptar = password_hash($contrasena,PASSWORD_DEFAULT);


    $Empleado->constructorEditar(@$_POST['idEmpleado'], @$_POST['nombre'], @$_POST['direccion'], @$_POST['idJornada'], @$_POST['idCargo'],@$_POST['correo'],$Encriptar); 
    echo json_encode($Empleado->editarEmpleado($conexion)); 
}