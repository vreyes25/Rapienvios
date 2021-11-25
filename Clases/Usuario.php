<?php
include "Respuesta.php";
class Usuario
{
    public $idUsuario;
    public $nombre;
    public $correo;
    public $usuario;
    public $contrasena;
    public $tipoCuenta;
    public $numeroIntento;

    public function _construct() {}

    public function ConstructorLogin($usuario, $contrasena){
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }

    public function ConstructorRegistro($nombre, $correo, $usuario, $contrasena){
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }

    public function login($conexion) {
        $Res = new Respuesta();
        if (trim($this->usuario) == "" || trim($this->contrasena) == "") {
            $Res->NoSucces("Debes escribir un usuario y una contraseña");
        } else {
            $query = "SELECT * FROM usuario WHERE usuario='$this->usuario'";
            $result = mysqli_query($conexion, $query);
            $nr  = mysqli_num_rows($result);

            $row = mysqli_fetch_array($result);
            if (/*($nr == 1) &&*/(password_verify($this->contrasena, $row['contrasena'])) ) {
                $Res->Succes("");
            } else {
               
                $Res->NoSucces("Usuario o contraseña incorrecta");
            }
        }
        return $Res;
    }



    public function registro($conexion) {
        $Res = new Respuesta();
        if(trim($this->nombre) == "") {
            $Res->NoSucces("Debes llenar el campo nombre");
        } else if(trim($this->correo) == "") {
            $Res->NoSucces("Debes llenar el campo correo");
        } else if(trim($this->usuario) == "") {
            $Res->NoSucces("Debes llenar el campo usuario");
        } else if(trim($this->contrasena) == "") {
            $Res->NoSucces("Debes llenar el campo contraseña");
        } else {
            mysqli_query($conexion, "INSERT INTO usuario(nombre, correo, usuario, contrasena) 
            VALUES ('$this->nombre', '$this->correo', '$this->usuario', '$this->contrasena')");
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo registrar el usuario" . $resultado.error);
            } else {
                $Res->Succes("El usuario fue registrado correctamente");
            }
        }
        return $Res;
    }
    //Editar



    //Buscar

    

    //Eliminar




}
