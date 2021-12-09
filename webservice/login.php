<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Cliente.php");
    $cliente = new Cliente();
    $contra = @$_POST['contrasena'];
    //$Encriptar = password_hash($contra,PASSWORD_DEFAULT);
    $cliente->ConstructorLogin(@$_POST['correo'], $contra); 
    echo json_encode($cliente->login($conexion)); 
}
?>