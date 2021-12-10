<?php
include "../php/conexion.php";

class Tamanio {
    public $idTamanio;
    public $descripcion;

    public function __construct(){}

    public function ConstructorPorDefecto($idTamanio, $descripcion){
        $this->idTamanio = $idTamanio;
        $this->descripcion = $descripcion;
    }

    public function obtenerTamanio($Conexion) {
        $consulta = "SELECT idTamanio, descripcion FROM tamanio";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Jornadas = new Tamanio();
            $Jornadas->ConstructorPorDefecto($fila['idTamanio'], $fila['descripcion']);
            $lista[] = $Jornadas;
        }
        return $lista;
    }
}