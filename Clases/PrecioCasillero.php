<?php
include "Respuesta.php";
class precioCasillero{

    public $idHistorial;
    //public $FechaLlegada;
    public $idCasillero;
    public $fechaInicio;
    public $fechaFinal;
    public $precio;

    function __construct() {

    }

    function constructorRegistrar($idCasillero,$fechaInicio,/*$fechaFinal,*/$precio){
        $this->idCasillero=$idCasillero;
        $this->fechaInicio=$fechaInicio;
        //$this->fechaFinal=$fechaFinal;
        $this->precio=$precio;
    }

    function constructorListar($idHistorial,$idCasillero,$fechaInicio,$fechaFinal,$precio){
        $this->idHistorial = $idHistorial;
        $this->idCasillero=$idCasillero;
        $this->fechaInicio=$fechaInicio;
        $this->fechaFinal=$fechaFinal;
        $this->precio=$precio;
    }

    function constructorEditar($idHistorial,$fechaFinal){
        $this->idHistorial = $idHistorial;
        $this->fechaFinal=$fechaFinal;
        
    }

    function registrarPrecio($conexion){
        $Res = new Respuesta();
        /*if (/*trim($this->FechaLlegada) == "") {
            //$Res->NoSucces("Debes ingresar la fecha de llegada");
        } else */if (trim($this->idCasillero) == "") {
            $Res->NoSucces("Debes ingresar tamaño");
        } /*else if (trim($this->fechaInicio) == "") {
            $Res->NoSucces("Debes ingresar la fecha en la que iniciará");
        }*/else if (trim($this->precio) == "") {
            $Res->NoSucces("Debes ingresar el precio");
        } else {
            mysqli_query($conexion,
                "INSERT into historialpreciocasillero(idCasillero, fechaInicio,precio)
                 values('$this->idCasillero','$this->fechaInicio','$this->precio')"
            );
            if (mysqli_error($conexion)) {
                $Res->NoSucces("No se pudo Registrar el Precio " . $conexion->error);
            } else {
                $Res->Succes("El precio fue registrado correctamente");
            }
        }
        return $Res;
    }

    public function editarPrecio($conexion)
    {
        

        $consulta = "UPDATE historialpreciocasillero SET 
        fechafinal = '$this->fechaFinal' WHERE idHistorial = '$this->idHistorial'";
        $Respuesta = new Respuesta();

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El Historial se ha actualizado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("Error al Actualizar" . $conexion->error);
            return $Respuesta;
        }
    }

    public function eliminarPaquete($conexion,$idHistorial)
    {
        $Respuesta = new Respuesta();
        $consulta = "DELETE FROM historialpreciocasillero WHERE idPaquete = '$idHistorial'";

        if (mysqli_query($conexion, $consulta)) {
            $Respuesta->Succes("El Paquete se ha eliminado correctamente");
            return $Respuesta;
        } else {
            $Respuesta->NoSucces("El paquete que desea eliminar no existe" . $conexion->error);
            return $Respuesta;
        }
    }

    /*function obtenerPaquetesbyCasillero ($conexion){
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
    }*/
    //Modificar
    public function buscarPrecio($conexion)
    {
        $consulta = "SELECT C.idHistorial, C.idCasillero, C.precio, C.fechaInicio, C.fechaFinal
        FROM historialpreciocasillero AS C WHERE C.idHistorial = '$this->idHistorial'";
        $Respuesta = new Respuesta();
        $Paquete = new precioCasillero();
        $ClienteEncontrado = mysqli_query($conexion, $consulta);
        $data = $ClienteEncontrado->fetch_assoc();

        if ($data != null) {
            $Paquete->ConstructorListar($data['idHistorial'], $data['idCasillero'], $data['precio'], $data['fechaInicio'],$data['fechaFinal']);
            return $Paquete;
        } else {
            $Respuesta->Error("Debe ingresar un ID");
            return $Respuesta;
        }
    }

    public function obtenerPrecios($conexion) {
        $consulta = "SELECT idHistorial, idCasillero, fechaInicio, fechaFinal, precio from historialpreciocasillero";
        $resultado = mysqli_query($conexion, $consulta);
        $lista = array();
        while ($fila = mysqli_fetch_array($resultado)) {
            $Empleados = new precioCasillero();
            $Empleados->constructorListar($fila['idHistorial'], $fila['idCasillero'], $fila['fechaInicio'], $fila['fechaFinal'], $fila['precio']);
            $lista[] = $Empleados;
        }
        return $lista;
    }
    

}
?>