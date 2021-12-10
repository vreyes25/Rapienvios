<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";
    $EmpleadoBuscado = new Envio();
    $EmpleadoBuscado->idEnvio = @$_POST['idEnvio'];
    date_default_timezone_set('America/Tegucigalpa');
    $EmpleadoBuscado->fechaRecibido = date(Y-m-d);
    echo json_encode($EmpleadoBuscado->EntregarEnvio($conexion));
}
?>