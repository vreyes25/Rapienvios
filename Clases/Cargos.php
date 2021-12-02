<?php
include "../php/conexion.php";

class Cargos {
    public $idCargo;
    public $descripcion;

    public function __construct(){}

    public function ConstructorPorDefecto($idCargo, $descripcion){
        $this->idCargo = $idCargo;
        $this->descripcion = $descripcion;
    }

    public function obtenerCargos($Conexion) {
        $consulta = "SELECT idCargo, descripcion FROM cargo";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Cargos = new Cargos();
            $Cargos->ConstructorPorDefecto($fila['idCargo'], $fila['descripcion']);
            $lista[] = $Cargos;
        }
        return $lista;
    }
}