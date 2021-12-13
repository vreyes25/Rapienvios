<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/tracking.php");
    $Tracking = new Tracking();

    $Tracking->constructorLlegada(@$_POST['trackingId'], @$_POST['fechaLlegada'], @$_POST['ubicacion'],@$_POST['idInventario']); 
    echo json_encode($Tracking->crearTracking($conexion)); 
}