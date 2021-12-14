<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";

    $Empleados = new Envio();
    //$Empleados->constructorTotal(@$_POST['total']);
    echo json_encode($Empleados->totalEnviosPendientes($conexion));
}
?>