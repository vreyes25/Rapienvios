<?php
include_once("Respuesta.php");
class Tracking{
    public $TrackingId;
    public $FechaLlegada;
    public $FechaSalida;
    public $Ubicacion;
    public $IdInventario;

    public function __construct() {}   
    
    public function constructorTracking($trackingId, $fechaLlegada, $fechaSalida, $ubicacion){

        $this->TrackingId = $trackingId;
        $this->FechaLlegada = $fechaLlegada;
        $this->FechaSalida = $fechaSalida;
        $this->Ubicacion = $ubicacion;
    }
    public function constructorTracking2($trackingId,$idInventario, $fechaLlegada, $fechaSalida, $ubicacion){
        $this->IdInventario = $idInventario;
        $this->TrackingId = $trackingId;
        $this->FechaLlegada = $fechaLlegada;
        $this->FechaSalida = $fechaSalida;
        $this->Ubicacion = $ubicacion;
    }

    public function constructorLlegada($trackingId, $fechaLlegada, $ubicacion, $idInventario){

        $this->TrackingId = $trackingId;
        $this->FechaLlegada = $fechaLlegada;
        $this->Ubicacion = $ubicacion;
        $this->IdInventario = $idInventario;
    }

    public function constructorTrackingMostrarEnvio($trackingId, $idPaquete){

        $this->TrackingId = $trackingId;
        $this->IdInventario = $idPaquete;
        
    }

    public function constructorTrackingActualizarEnvio($trackingId,$fechaSalida){
        $this->TrackingId = $trackingId;
        $this->FechaSalida = $fechaSalida;


    }

    public function crearTracking ($conexion){
        $Res = new Respuesta();
        if (trim($this->TrackingId) == "") {
            $Res->NoSucces("Debes ingresar el numero de Tracking.");
        } else if (trim($this->FechaLlegada) == "") {
            $Res->NoSucces("Debes ingresar la fecha en que se recivio el paquete.");
        } else if (trim($this->Ubicacion) == "") {
            $Res->NoSucces("Debes ingresar la ubiccacion actual del paquete");
        }else if (trim($this->IdInventario) == "") {
            $Res->NoSucces("Debes ingresar el nuemero de paquete");
        }else {
            mysqli_query($conexion,
                "INSERT into estadopaquete(idTracking, idPaquete,  fechaLlegada, fechaSalida, ubicacion)
                 values('$this->TrackingId','$this->FechaLlegada','' /* Fecha de salida en blanco*/,'$this->Ubicacion','$this->IdInventario')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el tracking" . $conexion->error);
            } else {
                $Res->Succes("El tracking fue guardado correctamente");
            }
        }
        return $Res;
    }

    public function obtenerTracking($conexion, $idInventario)
    {
        $consulta = "SELECT idTracking, fechaLlegada, fechaSalida, ubicacion
        FROM estadopaquete WHERE idPaquete = $idInventario";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Tracking = new Tracking();
            $Tracking->constructorTracking($fila['idTracking'], $fila['fechaLlegada'], $fila['fechaSalida'], $fila['ubicacion']);
            $lista[] = $Tracking;
        }
        return $lista;
    }

    public function actualizarTracking($conexion){
        $consulta = "UPDATE tracking SET ubicacion = '$this->Ubicacion', fechaLlegada = '$this->FechaLlegada', fechaSalida ='$this->FechaSalida' WHERE trackingId = '$this->TrackingId'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El tracking se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function crearTrackingConPaquete($conexion){
        $Res = new Respuesta();
        
        $query = "SELECT (`idPaquete`) as 'idPaquete' FROM `paquete` ORDER BY idPaquete DESC LIMIT 1";
        $result = mysqli_query($conexion, $query);
        //$nr  = mysqli_num_rows($result);
        //$nr +=1;
        $row = mysqli_fetch_array($result);
        $auxiliar = intval($row['idPaquete']);
       

            mysqli_query($conexion,
                "INSERT into tracking(idTracking, idPaquete,  fechaLlegada, fechaSalida, ubicacion)
                 values('$this->TrackingId','$auxiliar','$this->FechaLlegada','0000-00-00' /* Fecha de salida en blanco*/,'$this->Ubicacion')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el tracking" . $conexion->error);
            } else {
                $Res->Succes("El Paquete fue guardado correctamente");
            }
        
        return $Res;
    
    }
    


    public function obtenerTrackingPorPaquete($conexion,$idPaquete){
        $Res = new Respuesta();
        $query = "SELECT idTracking FROM `tracking` WHERE idPaquete=$idPaquete  LIMIT 1";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($result);
        $auxiliar = new Tracking();
        $auxiliar->constructorTrackingMostrarEnvio($row['idTracking'],$idPaquete);

        return $auxiliar;

        



        
    }


    public function actualizarTracking2($conexion){
        $consulta = "UPDATE tracking SET fechaSalida ='$this->FechaSalida' WHERE idTracking = $this->TrackingId AND fechaSalida='0000-00-00'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El tracking se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function crearTrackingParaEnvio($conexion){
        $Res = new Respuesta();
        
        
       

            mysqli_query($conexion,
                "INSERT into tracking(idTracking, idPaquete,  fechaLlegada, fechaSalida, ubicacion)
                 values('$this->TrackingId','$this->IdInventario','$this->FechaLlegada','0000-00-00','$this->Ubicacion')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el tracking" . $conexion->error);
            } else {
                $Res->Succes("El Paquete fue guardado correctamente");
            }
        
        return $Res;
    
    }



}




?>