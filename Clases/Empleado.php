<?php
include "Respuesta.php";

class Empleado {
    public $idEmpleado;
    public $nombre;
    public $direccion;
    public $idJornada;
    public $idCargo;
    public $correo;
    public $contrasena;
    public $total;

    public function _construct() {}

    public function ConstructorLogin($correo, $contrasena){
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }

    public function constructorSobrecargado($nombre, $direccion, $idJornada, $idCargo) {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->idJornada = $idJornada;
        $this->idCargo = $idCargo;
    }

    public function constructorEditar($idEmpleado, $nombre, $direccion, $idJornada, $idCargo) {
        $this->idEmpleado = $idEmpleado;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->idJornada = $idJornada;
        $this->idCargo = $idCargo;
    }

    public function constructorTotal($total) {
        $this->total = $total;
    }

    public function registrarEmpleado($conexion) {
        $Res = new Respuesta();
        if (trim($this->nombre) == "") {
            $Res->NoSucces("Debes ingresar el nombre");
        } else if (trim($this->direccion) == "") {
            $Res->NoSucces("Debes ingresar la dirección");
        } else if (trim($this->idJornada) == "0") {
            $Res->NoSucces("Debes seleccionar una jornada");
        } else if (trim($this->idCargo) == "0") {
            $Res->NoSucces("Debes seleccionar un cargo");
        } else {
            mysqli_query($conexion,
                "INSERT INTO empleado(nombre, direccion, idJornada, idCargo)
                 VALUES('$this->nombre','$this->direccion','$this->idJornada', '$this->idCargo')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el empleado " . $conexion->error);
            } else {
                $Res->Succes("El empleado fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function obtenerEmpleados($conexion) {
        $consulta = "SELECT E.idEmpleado, E.nombre, E.direccion, J.descripcion AS jornada, C.descripcion AS cargo
        FROM empleado AS E
        INNER JOIN jornadas AS J ON E.idJornada = J.idJornada
        INNER JOIN cargo AS C ON E.idCargo = C.idCargo";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Empleados = new Empleado();
            $Empleados->constructorEditar($fila['idEmpleado'], $fila['nombre'], $fila['direccion'], $fila['jornada'], $fila['cargo']);
            $lista[] = $Empleados;
        }
        return $lista;
    }

    public function totalEmpleados($conexion) {
        $consulta = "SELECT COUNT(*) AS totalEmpleados FROM empleado";
        $resultado = mysqli_query($conexion, $consulta);
        $total = mysqli_fetch_assoc($resultado);
        return $total;
    }

    public function editarEmpleado($conexion) {
        $consulta = "UPDATE empleado SET nombre = '$this->nombre', direccion = '$this->direccion',
        idJornada = '$this->idJornada', idCargo = '$this->idCargo' WHERE idEmpleado = '$this->idEmpleado'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El empleado se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function eliminarEmpleado($conexion) {
        $Respuesta = new Respuesta();
        $consulta = "DELETE FROM empleado WHERE idEmpleado = '$this->idEmpleado'";

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El empleado se ha eliminado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("El empleado que desea eliminar no existe" . $conexion->error);
            return $Respuesta;
        }
    }

    public function buscarEmpleado($conexion) {
        $consulta = "SELECT idEmpleado, nombre, direccion, idJornada, idCargo
        FROM empleado
        WHERE idEmpleado = '$this->idEmpleado'";
        $Respuesta = new Respuesta();
        $Empleado = new Empleado();
        $EmpleadoEncontrado = mysqli_query($conexion, $consulta);
        $data = $EmpleadoEncontrado->fetch_assoc();

        if ($data != null) {
            $Empleado->constructorEditar($data['idEmpleado'], $data['nombre'], $data['direccion'], $data['idJornada'], $data['idCargo']);
            return $Empleado;
        } else {
            $Respuesta->NoSucces("Debe ingresar un ID");
            return $Respuesta;
        }
    }

    public function login($conexion) {
        $Res = new Respuesta();
        if (trim($this->correo) == "" || trim($this->contrasena) == "") {
            $Res->NoSucces("Debes escribir un correo y una contraseña");
        } else {
            $query = "SELECT * FROM empleado WHERE correo='$this->correo'";
            $result = mysqli_query($conexion, $query);
            $nr  = mysqli_num_rows($result);

            $row = mysqli_fetch_array($result);
            if (($nr == 1) &&(password_verify($this->contrasena, $row['contrasena'])) ) {
                $Res->Succes("");
            } else {
                $Res->NoSucces("Correo o contraseña incorrecta");
            }
        }
        return $Res;
    }
}