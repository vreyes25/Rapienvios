<?php
include "Respuesta.php";
class Paquete{
//Codigo de Roger
    public $IdInventario;
    public $FechaLlegada;
    public $Descripcion;
    public $Peso;
    public $IdCasillero;

    function __construct() {

    }

    function constructorPaquete ($idInventario, $fechaLlegada, $Descripcion, $peso, $idCasillero){
        $this->IdInventario = $idInventario;
        $this->FechaLlegada = $fechaLlegada;
        $this->Descripcion = $Descripcion;
        $this->Peso = $peso;
        $this->IdCasillero = $idCasillero;
    }

    function registrarPaquete($conexion){
        $Res = new Respuesta();
        if (trim($this->FechaLlegada) == "") {
            $Res->NoSucces("Debes ingresar la fecha de llegada");
        } else if (trim($this->Descripcion) == "") {
            $Res->NoSucces("Debes ingresar la descripcion");
        } else if (trim($this->Peso) == "") {
            $Res->NoSucces("Debes ingresar el peso");
        }else if (trim($this->IdCasillero) == "") {
            $Res->NoSucces("Debes ingresar el casillero");
        } else {
            mysqli_query($conexion,
                "INSERT into paquete(idInventario, fechaLlegada, descripcion, peso,id_casillero)
                 values('$this->IdInventario','$this->Descripcion','$this->Peso','$this->IdCasillero')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el Paquete " . $conexion->error);
            } else {
                $Res->Succes("El Paquete fue registrado correctamente");
            }
        }
        return $Res;
    }

    function obtenerPaquetesbyCasillero ($conexion){
        $Res = new Respuesta();
        if (trim($this->idCasillero) == ""){
            $Res->NoSucces("ingrese un numero de casillero");
        } else {
            $query = "SELECT * FROM paquetes WHERE id_casillero='$this->IdCasillero'";
            $result = mysqli_query($conexion, $query);
            $nr  = mysqli_num_rows($result);

            $row = mysqli_fetch_array($result);
            if ($nr == 0){
                $Res->NoSucces("No se han encontrado Paquetes");
            }else{
                $Res->Succes(""); //Verificar como listar los datos en la tabla
            }
               
        }
    }
    

    

}
?>