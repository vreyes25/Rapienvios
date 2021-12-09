<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Empleado.php");
    $empleado = new Empleado();
    $contra = @$_POST['contrasena'];
    //$Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    $empleado->ConstructorLogin(@$_POST['correo'], $contra); 
    echo json_encode($empleado->login($conexion)); 
}
?>