<?php
if (isset($_POST)) {
    include "../php/conexion.php";
    include "../Clases/Casilleros.php";
    $Casilleros = new Casilleros();
    $Casilleros->ConstructorPorDefecto(@$_POST['idCasillero'], @$_POST['costoMensual'], @$_POST['idTamanio'], @$_POST['idCliente']);
    echo json_encode($Casilleros->obtenerCasillerosParaPaquetes($conexion));
}