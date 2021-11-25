<?php
include "Respuesta.php";
Class Cliente{
    public $idCliente;
    public $nombre;
    public $telefono;
    public $direccion;
    public $estado;


    public function _construct(){

    }

    public function constructorSobrecargado($nombre,$telefono,$direccion){
        
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        
    }

    public function registrarCliente($conexion){
        $Res = new Respuesta();
        if (trim($this->nombre)=="" || trim($this->telefono)=="" || trim($this->direccion)==""){
        $Res->NoSucces("No puede haber campos en blanco");
            }else{
                mysqli_query($conexion,
                "INSERT into cliente(nombre,telefono,direccion,estado)
                 values('$this->nombre','$this->telefono','$this->direccion',true)"
        );
        if (mysqli_error($conexion)){
            $Res->NoSucces("Error al Insertar: " . $conexion->error);
        }else{
            $Res->Succes("Se Inserto Correctamente el Cliente: ".$this->nombre );
            }
        }
    return $Res;

    }


}





?>