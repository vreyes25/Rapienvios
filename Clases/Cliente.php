<?php
include "Respuesta.php";

class Cliente {
    public $idCliente;
    public $nombre;
    public $telefono;
    public $direccion;
    public $idEstado;
    public $correo;
    public $idCasillero;
    public $contrasena;
    public $total;

    public function _construct() {}

    public function ConstructorLogin($correo, $contrasena){
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }

    public function ConstructorCambiarContrasena($nombre, $contrasena){
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
    }

    public function constructorSobrecargado($nombre, $telefono, $direccion) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }

    public function constructorEditar($idCliente, $nombre, $telefono, $direccion) {
        $this->idCliente = $idCliente;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }


    public function constructorEditarData($correo, $nombre, $telefono, $direccion, $idCasillero) {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->idCasillero = $idCasillero;
    }


    public function constructorReporte($idCliente, $nombre, $telefono, $direccion, $idEstado,$correo) {

        $this->idCliente = $idCliente;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->idEstado = $idEstado;
        $this->correo = $correo;
    }

    public function constructorTotal($total) {
        $this->total = $total;
    }

    public function constructorData($nombre, $telefono, $direccion, $correo, $idCasillero) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->idCasillero = $idCasillero;
    }
    

    public function ConstructorRegistro($nombre, $telefono, $direccion, $correo, $contrasena) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
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
                "INSERT into cliente(nombre,telefono,direccion)
                 values('$this->nombre','$this->telefono','$this->direccion')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el cliente " . $conexion->error);
            } else {
                $Res->Succes("El cliente fue registrado correctamente");
            }
        }
        return $Res;
    }


    public function obtenerClientes($conexion, $valor)
    {
        $consulta = "SELECT C.idCliente, C.nombre, C.telefono, C.direccion, E.estado, C.correo
        FROM cliente AS C
        INNER JOIN estados AS E ON C.idEstado = E.idEstado WHERE C.nombre LIKE '%$valor%' OR C.correo LIKE '%$valor%'";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Clientes = new Cliente();
            $Clientes->constructorReporte($fila['idCliente'], $fila['nombre'], $fila['telefono'], $fila['direccion'], $fila['estado'],$fila['correo']);
            $lista[] = $Clientes;
        }
        return $lista;
    }

    public function totalClientes($conexion)
    {
        $consulta = "SELECT COUNT(*) AS totalClientes FROM cliente";
        $resultado = mysqli_query($conexion, $consulta);
        $total = mysqli_fetch_assoc($resultado);
        return $total;
    }

    public function editarCliente($conexion) {
        $consulta = "UPDATE cliente SET nombre = '$this->nombre', telefono = '$this->telefono',
        direccion = '$this->direccion' WHERE idCliente = '$this->idCliente'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El cliente se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function eliminarCliente($conexion)
    {
        $Respuesta = new Respuesta();
        $consulta = "DELETE FROM cliente WHERE idCliente = '$this->idCliente'";

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El cliente se ha eliminado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("El cliente que desea eliminar no existe" . $conexion->error);
            return $Respuesta;
        }
    }

    public function buscarCliente($conexion) {
        $consulta = "SELECT C.idCliente, C.nombre, C.telefono, C.direccion, E.estado
        FROM cliente AS C
        INNER JOIN estados AS E ON C.idEstado = E.idEstado
        WHERE C.idCliente = '$this->idCliente'";
        $Respuesta = new Respuesta();
        $Cliente = new Cliente();
        $ClienteEncontrado = mysqli_query($conexion, $consulta);
        $data = $ClienteEncontrado->fetch_assoc();

        if ($data != null) {
            $Cliente->constructorReporte($data['idCliente'], $data['nombre'], $data['telefono'], $data['direccion'], $data['estado']);
            return $Cliente;
        } else {
            $Respuesta->Error("Debe ingresar un ID");
            return $Respuesta;
        }
    }

    public function registro($conexion) {
        $Res = new Respuesta();
        if(trim($this->nombre) == "") {
            $Res->NoSucces("Debes llenar el campo nombre");
        } else if(trim($this->telefono) == "") {
            $Res->NoSucces("Debes llenar el campo teléfono");
        } else if(trim($this->direccion) == "") {
            $Res->NoSucces("Debes llenar el campo direccion");
        } else if(trim($this->correo) == "") {
            $Res->NoSucces("Debes llenar el campo correo");
        } else if(trim($this->contrasena) == "") {
            $Res->NoSucces("Debes llenar el campo contraseña");
        } else {
            mysqli_query($conexion, "INSERT INTO cliente(nombre, telefono, direccion, correo, contrasena) 
            VALUES ('$this->nombre', '$this->telefono', '$this->direccion', '$this->correo', '$this->contrasena')");
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo registrar el cliente" . $resultado.error);
            } else {
                $Res->Succes("El cliente fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function login($conexion) {
        $Res = new Respuesta();
        if (trim($this->correo) == "" || trim($this->contrasena) == "") {
            $Res->NoSucces("Debes escribir un correo y una contraseña");
        } else {
            $query = "SELECT * FROM cliente WHERE correo='$this->correo'";
            $result = mysqli_query($conexion, $query);
            $nr  = mysqli_num_rows($result);

            $row = mysqli_fetch_array($result);
            if (($nr == 1) &&(password_verify($this->contrasena, $row['contrasena'])) ) {
                Session_start();
                $_SESSION['usuario'] = $row['nombre'];
                
                $Res->Succes("");
            } else {
                $Res->NoSucces("Correo o contraseña incorrecta");
            }
        }
        return $Res;
    }

    public function cambiarContrasena($conexion) {
        $consulta = "UPDATE cliente SET contrasena = '$this->contrasena' WHERE nombre = '$this->nombre'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("La contraseña se fue actualizada correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function buscarClienteInfo($conexion) {
        $consulta = "SELECT nombre, telefono, direccion, correo, idCasillero
        FROM cliente
        WHERE nombre = '$this->nombre'";
        $Respuesta = new Respuesta();
        $Cliente = new Cliente();
        $ClienteEncontrado = mysqli_query($conexion, $consulta);
        $data = $ClienteEncontrado->fetch_assoc();

        if ($data != null) {
            $Cliente->constructorData($data['nombre'], $data['telefono'], $data['direccion'], $data['correo'], $data['idCasillero']);
            return $Cliente;
        } else {
            $Respuesta->Error("Debe ingresar un nombre");
            return $Respuesta;
        }
    }

    public function editarClienteData($conexion) {
        $consulta = "UPDATE cliente SET nombre = '$this->nombre', telefono = '$this->telefono',
        direccion = '$this->direccion', idCasillero = '$this->idCasillero' 
        WHERE correo = '$this->correo'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El cliente se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }
}