<?php
include "Respuesta.php";
class Paquete{
//Codigo de Roger
    public $IdInventario;
    //public $FechaLlegada;
    public $Descripcion;
    public $Peso;
    public $IdCasillero;

    function __construct() {

    }

    function constructorPaquete ($idInventario, /*$fechaLlegada,*/ $Descripcion, $peso, $idCasillero){
        $this->IdInventario = $idInventario;
        //$this->FechaLlegada = $fechaLlegada;
        $this->Descripcion = $Descripcion;
        $this->Peso = $peso;
        $this->IdCasillero = $idCasillero;
    }

    function constructorPaqueteRegistrar (/*$idInventario, $fechaLlegada,*/ $Descripcion, $peso, $idCasillero){
        //$this->IdInventario = $idInventario;
        //$this->FechaLlegada = $fechaLlegada;
        $this->Descripcion = $Descripcion;
        $this->Peso = $peso;
        $this->IdCasillero = $idCasillero;
    }

    function registrarPaquete($conexion){
        $Res = new Respuesta();
        /*if (/*trim($this->FechaLlegada) == "") {
            //$Res->NoSucces("Debes ingresar la fecha de llegada");
        } else */if (trim($this->Descripcion) == "") {
            $Res->NoSucces("Debes ingresar la descripcion");
        } else if (trim($this->Peso) == "") {
            $Res->NoSucces("Debes ingresar el peso");
        }else if (trim($this->IdCasillero) == "") {
            $Res->NoSucces("Debes ingresar el casillero");
        } else {
            mysqli_query($conexion,
                "INSERT into paquete(descripcion, peso,idCasillero)
                 values('$this->Descripcion','$this->Peso','$this->IdCasillero')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo guardar el Paquete " . $conexion->error);
            } else {
                $Res->Succes("El Paquete fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function editarPaquete($conexion)
    {
        

        $consulta = "UPDATE paquete SET descripcion = '$this->Descripcion', peso = '$this->Peso',
        idCasillero = '$this->IdCasillero' WHERE idPaquete = '$this->IdInventario'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El Paquete se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al modificar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function eliminarPaquete($conexion, $idPaquete)
    {
        $Respuesta = new Respuesta();
        $consulta = "DELETE FROM paquete WHERE idPaquete = '$idPaquete'";

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El Paquete se ha eliminado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("El paquete que desea eliminar no existe" . $conexion->error);
            return $Respuesta;
        }
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
    
    public function buscarPaquete($conexion)
    {
        $consulta = "SELECT C.idPaquete, C.descripcion, C.peso, C.idCasillero
        FROM paquete AS C WHERE C.idPaquete = '$this->IdInventario'";
        $Respuesta = new Respuesta();
        $Paquete = new Paquete();
        $ClienteEncontrado = mysqli_query($conexion, $consulta);
        $data = $ClienteEncontrado->fetch_assoc();

        if ($data != null) {
            $Paquete->constructorReporte($data['idPaquete'], $data['descripcion'], $data['peso'], $data['idCasillero']);
            return $Paquete;
        } else {
            $Respuesta->Error("Debe ingresar un ID");
            return $Respuesta;
        }
    }

    public function obtenerPaquetes($conexion) {
        $consulta = "SELECT idPaquete, descripcion, peso, idCasillero from paquete";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Empleados = new Empleado();
            $Empleados->constructorEditar($fila['idEmpleado'], $fila['nombre'], $fila['direccion'], $fila['jornada'], $fila['cargo']);
            $lista[] = $Empleados;
        }
        return $lista;
    }
    

}
?>