<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/tracking.php");
    $Tracking = new Tracking();

    date_default_timezone_set('America/Tegucigalpa');
    
    $Tracking->constructorTrackingActualizarEnvio(@$_POST['trackingId'], date('Y-m-d')); 
    $Tracking->actualizarTracking2($conexion);


    $Nuevo = new Tracking();
    $Nuevo->constructorTracking2(@$_POST['trackingId'],@$_POST['idPaquete'], date('Y-m-d'), '', @$_POST['Ubicacion']);
    
    echo json_encode($Nuevo->crearTrackingParaEnvio($conexion)); 
}