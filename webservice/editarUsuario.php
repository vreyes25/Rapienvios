<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Usuario.php");

    $usuario = new Usuario();
    $contrasena = @$_POST['contrasena'];
    $Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    $usuario->ConstructorEditar(@$_POST['idUsuario'],@$_POST['nombre'],@$_POST['correo'],@$_POST['usuario'],$Encriptar);
    echo json_encode($usuario->editar($conexion));




}



?>