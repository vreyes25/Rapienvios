<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Paquetes.php";

    $Paquetes = new Paquete();
    $Paquetes->constructorTotal(@$_POST['total']);
    echo json_encode($Paquetes->totalPaquetes($conexion));
}