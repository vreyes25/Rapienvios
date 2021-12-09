<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/Paquete.php");
    $Empleado = new Paquete();

    
    echo json_encode($Empleado->eliminarPaquete($conexion,@$_POST['idPaquete'])); 
}
?>