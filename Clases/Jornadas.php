<?php
include "../php/conexion.php";

class Jornada {
    public $idJornada;
    public $descripcion;

    public function __construct(){}

    public function ConstructorPorDefecto($idJornada, $descripcion){
        $this->idJornada = $idJornada;
        $this->descripcion = $descripcion;
    }

    public function obtenerJornadas($Conexion) {
        $consulta = "SELECT idJornada, descripcion FROM jornadas";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Jornadas = new Jornada();
            $Jornadas->ConstructorPorDefecto($fila['idJornada'], $fila['descripcion']);
            $lista[] = $Jornadas;
        }
        return $lista;
    }
}