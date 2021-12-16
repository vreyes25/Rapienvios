<?php

Class Auxiliar{
    public $idEnvio;
    public $idPaquete;
    public $descripcion;
    public $cliente;
    public $direccion;
    public $telefono; 
    public $ubicacion;


    public function __construct(){}

    public function constructorS($idEnvio,$idPaquete,$descripcion,$cliente,$direccion,$telefono,$ubicacion){
        $this->idEnvio = $idEnvio;
        $this->idPaquete = $idPaquete;
        $this->descripcion = $descripcion;
        $this->cliente = $cliente;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->ubicacion = $ubicacion;


    }






    public function mostrarInfoEnvio($conexion){
        $query = "SELECT envio.idEnvio, envio.idPaquete, paquete.descripcion, cliente.nombre, cliente.direccion, cliente.telefono, tracking.ubicacion 
        FROM envio,paquete,cliente,casillero,tracking 
        WHERE envio.idPaquete = $this->idPaquete AND envio.idPaquete=paquete.idPaquete AND paquete.idCasillero = casillero.idCasillero 
        AND casillero.idCasillero = cliente.idCasillero AND paquete.idPaquete = tracking.idPaquete 
        ORDER BY tracking.id DESC LIMIT 1";

        $resultado = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_array($resultado);

        $Info = new Auxiliar();
        $Info->constructorS($fila['idEnvio'],$fila['idPaquete'],$fila['descripcion'],$fila['nombre'],$fila['direccion'],$fila['telefono'],$fila['ubicacion']);

        return $Info;

    }

}




?>