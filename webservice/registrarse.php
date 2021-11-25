<?php
if(isset($_POST)){
    include "../php/conexion.php";
    include "../Clases/Usuario.php";
    $usuario = new Usuario();
    $usuario->ConstructorRegistro(@$_POST['nombre'], @$_POST['correo'], @$_POST['usuario'], @$_POST['contrasena']);
    echo json_encode($usuario->registro($conexion));
}
?>