<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/PrecioCasillero.php";

    $Clientes = new precioCasillero();
    //$Clientes->constructorTotal(@$_POST['total']);
    echo json_encode($Clientes->totalPrecios($conexion));
}
?>