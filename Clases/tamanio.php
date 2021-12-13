<?php
include "../php/conexion.php";

class Tamanio {
    public $idTamanio;
    public $descripcion;
    public $Precio;

    public function __construct(){}

    public function ConstructorPorDefecto($idTamanio, $descripcion, $precio){
        $this->idTamanio = $idTamanio;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
    }

    public function obtenerTamanio($Conexion) {
        $consulta = "SELECT idTamanio, descripcion, Precio FROM tamanio";
        $resultado = mysqli_query($Conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Jornadas = new Tamanio();
            $Jornadas->ConstructorPorDefecto($fila['idTamanio'], $fila['descripcion'], $fila['Precio']);
            $lista[] = $Jornadas;
        }
        return $lista;
    }
}