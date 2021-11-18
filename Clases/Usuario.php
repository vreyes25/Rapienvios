<?php

    include("Respuesta.php");
    Class Usuario{
        private $idUsuario;
        private $nombreUsuario;
        private $contrasenia;
        private $tipoCuenta;
        private $numeroIntento;

        function _construct(){

        }

        function getIdUsuario(){
            return $this->idUsuario;
        }
        function setIdUsuario($idUsuario){
            $this->idUsuario=$idUsuario;
        }
        function getNombreUsuario(){
            return $this->nombreUsuario;
        }
        function setNombreUsuario($nombre){
             $this->nombreUsuario=$nombre;
        }
        function getContrasenia(){
            return $this->contrasenia;
        }
        function setContrasenia($contra){
            $this->contrasenia=$contra;
       }
       function getTipoCuenta(){
           return $this->tipoCuenta;
       }
       function setTipoCuenta($tipo){
           $this->tipoCuenta=$tipo;
       }
       function getNumeroIntento(){
           return $this->numeroIntento;
       }
       function setNumeroIntento($num){
           $this->numeroIntento=$num;
       }

       function login($conexion,$corre,$contra){

        $Res = new Respuesta();
        if(trim($corre)=="" || trim($contra)==""){
            $Res->NoSucces("Usuario o contraseña en blanco");

        }
        else{
        $query = "SELECT count(*) as encontra from usuario where nombreUsuario='$corre' and pass= '$contra'";
        $result = mysqli_query($conexion, $query);
        $row =  mysqli_fetch_array($result);
            if($row['encontra']=="0"){

                $Res->NoSucces("Usuario o contraseña incorrecta");
            }
            else{
                $Res->Succes("");
            }
        }

        return $Res;


    }



    }





?>