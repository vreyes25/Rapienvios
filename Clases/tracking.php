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

    }



?>