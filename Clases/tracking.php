<?php
    include "Respuesta.php";
    class Tracking{
        public $TrackingId;
        public $FechaLlegada;
        public $FechaSalida;
        public $Ubicacion;
        public $IdInventario;
        
        function __construct()
        {
            
        }

        function constructorTracking ($trackingId, $fechaLlegada, $ubicacion, $idInventario){
            $this->TrackingId = $trackingId;
            $this->FechaLlegada = $fechaLlegada;
            $this->Ubicacion = $ubicacion;
            $this->IdInventario = $idInventario;
        }

        function registrarLlegada ($conexion){
            $Res = new Respuesta();

            if (trim($this->TrackingId) == "") {
                $Res->NoSucces("Debes ingresar la fecha de llegada");
            } else if (trim($this->FechaLlegada) == "") {
                $Res->NoSucces("Debes ingresar la descripcion");
            } else if (trim($this->Ubicacion) == "") {
                $Res->NoSucces("Debes ingresar el peso");
            }else if (trim($this->IdInventario) == "") {
                $Res->NoSucces("Debes ingresar el casillero");
            } else {

                mysqli_query($conexion,
                    "INSERT into estadopaquete(trackingId, fechaLlegada, fechaSalida, ubicacion, idInventario)
                     values('$this->TrackingId','$this->FechaLlegada','$this->FechaSalida', '$this->Ubicacion','$this->IdCasillero')"
                );
                if (mysqli_error($conexion)) {
                    $Res->NoSucces("No se pudo registrar la ubicacion" . $conexion->error);
                } else {
                    $Res->Succes("La ubicacion fue registrada correctamente");
                }
            }
            return $Res;
        }

        function registrarSalida ($conexion){
            $Res = new Respuesta;

            if (trim($this->FechaSalida) == "") {
                $Res->NoSucces("Debe ingresar la fecha de Salida.");
            }else{
                mysqli_query($conexion,
                    "UPDATE estadopaquete SET fechaSalida = $this->FechaSalida WHERE idInventario = $this->IdInventario"
                );
                if (mysqli_error($conexion)) {
                    $Res->NoSucces("No se pudo registrar la salida" . $conexion->error);
                } else {
                    $Res->Succes("La salida fue registrada correctamente");
                }
            }
        }
 
    

    public function constructorLlegada($trackingId, $fechaLlegada, $ubicacion, $idInventario){

        $this->TrackingId = $trackingId;
        $this->FechaLlegada = $fechaLlegada;
        $this->Ubicacion = $ubicacion;
        $this->IdInventario = $idInventario;
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

    
}
?>