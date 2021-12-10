<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/tracking.php");
    $Tracking = new Tracking();

    $Tracking->constructorTracking(@$_POST['trackingId'], @$_POST['fechaLlegada'],@$_POST['fechaSalida'], @$_POST['ubicacion']); 
    echo json_encode($Tracking->actualizarTracking($conexion)); 
}