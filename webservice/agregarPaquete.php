<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Paquete.php");
    include("../Clases/trackings.php");
    $Empleado = new Paquete();

    $track = new Tracking();


    date_default_timezone_set('America/Tegucigalpa');

    $track->constructorTracking(@$_POST['tracking'], date('Y-m-d'), '', 'Miami, Estados Unidos');

    
    $Empleado->constructorPaqueteRegistrar(@$_POST['descripcion'], @$_POST['peso'], @$_POST['casillero']); 
    $Empleado->registrarPaquete($conexion); 

    
    echo json_encode($track->crearTrackingConPaquete($conexion));

}