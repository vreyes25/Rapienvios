<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Empleado.php";

    $Empleados = new Empleado();
    $Empleados->constructorTotal(@$_POST['total']);
    echo json_encode($Empleados->totalEmpleados($conexion));
}
?>