<?php
include "Respuesta.php";
class Usuario
{
    private $idUsuario;
    private $nombreUsuario;
    private $contrasenia;
    private $tipoCuenta;
    private $numeroIntento;

    public function _construct()
    {

    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function setNombreUsuario($nombre)
    {
        $this->nombreUsuario = $nombre;
    }
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function setContrasenia($contra)
    {
        $this->contrasenia = $contra;
    }
    public function getTipoCuenta()
    {
        return $this->tipoCuenta;
    }
    public function setTipoCuenta($tipo)
    {
        $this->tipoCuenta = $tipo;
    }
    public function getNumeroIntento()
    {
        return $this->numeroIntento;
    }
    public function setNumeroIntento($num)
    {
        $this->numeroIntento = $num;
    }

    public function login($conexion, $corre, $contra) 
    {

        $Res = new Respuesta();
        if (trim($corre) == "" || trim($contra) == "") {
            $Res->NoSucces("Debes escribir un usuario y una contraseña");
        } else {
            $query = "SELECT count(*) AS encontra FROM usuario WHERE nombreUsuario='$corre' AND pass= '$contra'";
            $result = mysqli_query($conexion, $query);
            $row = mysqli_fetch_array($result);
            if ($row['encontra'] == "0") {
                $Res->NoSucces("Usuario o contraseña incorrecta");
            } else {
                $Res->Succes("");
            }
        }
        return $Res;
    }
}
