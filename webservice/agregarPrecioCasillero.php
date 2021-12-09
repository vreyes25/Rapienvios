<?php
if(isset($_POST)){
    include("../php/conexion.php");
    include("../Clases/PrecioCasillero.php");
    $Empleado = new precioCasillero();

    date_default_timezone_set('America/Tegucigalpa');
    //Falta la modificacion del registro anterior
    $fechainicio = date('Y-m-d');
    $idCasillero = @$_POST['idTipoCasillero'];

    $consulta="SELECT `idHistorial`, `idCasillero`, `precio`,`fechaInicio`, fechaFinal FROM `historialpreciocasillero` 
    WHERE idCasillero=$idCasillero and fechaFinal IS null";

    $result = mysqli_query($conexion, $consulta);

    $nr  = mysqli_num_rows($result);

    $row = mysqli_fetch_array($result);
    if (($nr == 1)) {
        $idHistorial = $row['idHistorial'];
        $edicionPrecio = new precioCasillero();
        $edicionPrecio->constructorEditar($idHistorial,$fechainicio);
        $edicionPrecio->editarPrecio($conexion);
        
        $Empleado->constructorRegistrar($idCasillero,$fechainicio,@$_POST['precio']);
        echo json_encode($Empleado->registrarPrecio($conexion));
        //Tomar el valor y modificar el anterior

    } else { 
        $Empleado->constructorRegistrar($idCasillero,$fechainicio,@$_POST['precio']);
        echo json_encode($Empleado->registrarPrecio($conexion));
    //Agregar unicamente
    }


}
?>