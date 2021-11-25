<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Usuario.php");
    $usuario = new Usuario();
    $usuario->ConstructorLogin(@$_POST['usuario'], @$_POST['contrasena']); 
    echo json_encode($usuario->login($conexion)); 
}
?>