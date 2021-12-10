<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $Cliente = new Cliente();
    $contrasena = @$_POST['contrasena'];
    $encriptar = password_hash($contrasena,PASSWORD_DEFAULT);
    $Cliente->ConstructorCambiarContrasena(@$_POST['nombre'], $encriptar); 
    echo json_encode($Cliente->cambiarContrasena($conexion)); 
}
?>