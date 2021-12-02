<?php
include "Respuesta.php";

class Cliente {
    public $idCliente;
    public $nombre;
    public $telefono;
    public $direccion;
    public $estado;

    public function _construct() {}

    public function constructorSobrecargado($nombre, $telefono, $direccion) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }
    public function constructorSobrecargadoListar($idCliente,$nombre, $telefono, $direccion) {
        $this->idCliente = $idCliente;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }

    public function registrarCliente($conexion) {
        $Res = new Respuesta();
        if (trim($this->nombre) == "") {
            $Res->NoSucces("Debes ingresar el nombre");
        } else if (trim($this->telefono) == "") {
            $Res->NoSucces("Debes ingresar el teléfono");
        } else if (trim($this->direccion) == "") {
            $Res->NoSucces("Debes ingresar la dirección");
        } else {
            mysqli_query($conexion,
                "INSERT into cliente(nombre,telefono,direccion,estado)
                 values('$this->nombre','$this->telefono','$this->direccion',true)"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el cliente " . $conexion->error);
            } else {
                $Res->Succes("El cliente fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function listarCliente($conexion){

        $query = "SELECT idCliente, nombre, telefono, direccion, estado from cliente";
        $result = mysqli_query($conexion, $query);
        $lista = array();
            while ($row = mysqli_fetch_array($result))
      {
        $Categoria = new Cliente();
        $Categoria->constructorSobrecargadoListar($row['idCliente'],$row['nombre'],$row['direccion'],$row['estado']);
        $lista[]=$Categoria;
    
      }
      return $lista;
  
  

    }

}
