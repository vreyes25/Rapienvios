<?php
if(isset($_POST)){
    include "../php/conexion.php";
    include "../Clases/Cliente.php";
    $cliente = new Cliente();
    $contra = @$_POST['contrasena'];
    $Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    $cliente->ConstructorRegistro(@$_POST['nombre'], @$_POST['telefono'], @$_POST['direccion'], @$_POST['correo'], $Encriptar);
    echo json_encode($cliente->registro($conexion));
}
?>