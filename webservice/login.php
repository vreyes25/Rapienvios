<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Usuario.php");
    $correo=@$_POST["usuario"];
    $contrasena=@$_POST["contra"]; 
    $usu= new Usuario();
    $temporal = $usu->login($conexion,$correo,$contrasena); 
    echo json_encode($usu->login($conexion,$correo,$contrasena)); 
}
?>