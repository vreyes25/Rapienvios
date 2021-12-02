<?php
include "../php/conexion.php";

class Casilleros {
    public $idCasillero;
    public $costoMensual;
    public $idTamanio;
    public $idCliente;

    public function __construct(){}

    public function ConstructorPorDefecto($idCasillero, $costoMensual, $idTamanio, $idCliente){
        $this->idCasillero = $idCasillero;
        $this->costoMensual = $costoMensual;
        $this->idTamanio = $idTamanio;
        $this->idCliente = $idCliente;
    }

    public function obtenerCasilleros($Conexion) {
        $consulta = "SELECT idCasillero, costoMensual, idTamanio, idCliente FROM casillero";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Casilleros = new Casilleros();
            $Casilleros->ConstructorPorDefecto($fila['idCasillero'], $fila['costoMensual'], $fila['idTamanio'], $fila['idCliente']);
            $lista[] = $Casilleros;
        }
        return $lista;
    }
}