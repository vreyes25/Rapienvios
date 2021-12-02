<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Empleado.php";
    $EmpleadoBuscado = new Empleado();
    $EmpleadoBuscado->idEmpleado = @$_POST['idEmpleado'];
    echo json_encode($EmpleadoBuscado->eliminarEmpleado($conexion));
}
?>