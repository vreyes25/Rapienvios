<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Envio.php";
    include "../Clases/Paquete.php";


    $EmpleadoBuscado = new Envio();
    $EmpleadoBuscado->idEnvio = @$_POST['idEnvio'];

    $Paquete = new Paquete();
    $Paquete->IdInventario = @$_POST['paquete'];

    date_default_timezone_set('America/Tegucigalpa');
    $EmpleadoBuscado->fechaRecibido = date('Y-m-d');
    $Paquete->desactivarPaquete($conexion);
    echo json_encode($EmpleadoBuscado->EntregarEnvio($conexion));
}
?>