<?php
include "Respuesta.php";

class Paquete {
    public $idPaquete;
    public $descripcion;
    public $peso;
    public $idCasillero;
    public $total;

    public function _construct() {}

    public function constructorSobrecargado($descripcion, $peso, $idCasillero) {
        $this->descripcion = $descripcion;
        $this->peso = $peso;
        $this->idCasillero = $idCasillero;
    }

    public function constructorEditar($idPaquete, $descripcion, $peso, $idCasillero) {
        $this->idPaquete = $idPaquete;
        $this->descripcion = $descripcion;
        $this->peso = $peso;
        $this->idCasillero = $idCasillero;
    }

    public function constructorTotal($total) {
        $this->total = $total;
    }

    public function registrarPaquete($conexion) {
        $Res = new Respuesta();
        if (trim($this->descripcion) == "") {
            $Res->NoSucces("Debes ingresar la descripcion");
        } else if (trim($this->peso) == "") {
            $Res->NoSucces("Debes ingresar el peso");
        } else if (trim($this->idCasillero) == "") {
            $Res->NoSucces("Debes seleccionar el ID del casillero");
        } else {
            mysqli_query($conexion,
                "INSERT INTO paquete(descripcion,peso,idCasillero)
                 VALUES('$this->descripcion','$this->peso','$this->idCasillero')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el paquete " . $conexion->error);
            } else {
                $Res->Succes("El paquete fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function obtenerPaquetes($conexion) {
        $consulta = "SELECT idPaquete, descripcion, peso, idCasillero
        FROM paquete";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Paquetes = new Paquete();
            $Paquetes->constructorEditar($fila['idPaquete'], $fila['descripcion'], $fila['peso'], $fila['idCasillero']);
            $lista[] = $Paquetes;
        }
        return $lista;
    }

    public function totalPaquetes($conexion) {
        $consulta = "SELECT COUNT(*) AS totalPaquetes FROM paquete";
        $resultado = mysqli_query($conexion, $consulta);
        $total = mysqli_fetch_assoc($resultado);
        return $total;
    }

    public function editarPaquete($conexion) {
        $consulta = "UPDATE paqeute SET descripcion = '$this->descripcion', peso = '$this->peso',
        idCasillero = '$this->idCasillero' WHERE idPaquete = '$this->idPaquete'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El paquete se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function eliminarPaquete($conexion) {
        $Respuesta = new Respuesta();
        $consulta = "DELETE FROM paquete WHERE idPaquete = '$this->idPaquete'";

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El paquete se ha eliminado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("El paquete que desea eliminar no existe" . $conexion->error);
            return $Respuesta;
        }
    }

    public function buscarPaquete($conexion) {
        $consulta = "SELECT idPaquete, descripcion, peso, idCasillero
        FROM Paquete
        WHERE idPaquete = '$this->idPaquete'";
        $Respuesta = new Respuesta();
        $Paquete = new Paquete();
        $PaqueteEncontrado = mysqli_query($conexion, $consulta);
        $data = $PaqueteEncontrado->fetch_assoc();

        if ($data != null) {
            $Paquete->constructorEditar($data['idPaquete'], $data['descripcion'], $data['peso'], $data['idCasillero']);
            return $Paquete;
        } else {
            $Respuesta->Error("Debe ingresar un ID");
            return $Respuesta;
        }
    }
}