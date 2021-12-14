<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/tracking.php";

    $Tracking = new Tracking();
    echo json_encode($Tracking->obtenerTracking($conexion,@$_POST['id']));

    
}
?>