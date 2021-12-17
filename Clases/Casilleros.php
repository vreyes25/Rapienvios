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


    public function ConstructorDetalle($idCasillero, $idTamanio){
        $this->idCasillero = $idCasillero;
        $this->idTamanio = $idTamanio;
    }
    public function ConstructorParaPaquete($idCasillero){
        $this->idCasillero = $idCasillero;
        

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


    public function obtenerCasilleroDetalle($Conexion) {
        $consulta = "SELECT C.idCasillero, T.descripcion  
        FROM casillero AS C
        INNER JOIN tamanio AS T ON C.idTamanio = T.idTamanio";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Casilleros = new Casilleros();
            $Casilleros->ConstructorDetalle($fila['idCasillero'], $fila['descripcion']);
            $lista[] = $Casilleros;
        }
        return $lista;
    }

    public function obtenerCasillerosParaPaquetes($conexion){
        $consulta = "SELECT idCasillero FROM casillero";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Casilleros = new Casilleros();
            $Casilleros->ConstructorParaPaquete($fila['idCasillero']);
            $lista[] = $Casilleros;
        }
        return $lista;

        

    }
}