<?php
Session_start();

if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
  header('Location:loginAdmin.php');
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/dashboard.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <div class="decoration-line"></div>
      <ul class="dashboard-elements">
      <a href="dashboard.php">
          <li>
            <i class="ri-folder-user-fill side-icons"></i>
            Clientes
          </li>
        </a>

        <a href="paquetes.php">
          <li>
            <i class="ri-dropbox-fill side-icons"></i>
            Paquetes
          </li>
        </a>

        <a href="preciosCasillero.php">
          <li>
            <i class="ri-price-tag-3-fill side-icons"></i>
            Precios
          </li>
        </a>

        <a href="empleados.php">
          <li class="active">
            <i class="ri-user-fill side-icons"></i>
            Empleados
          </li>
        </a>

        <a href="envios.php">
          <li>
            <i class="ri-plane-fill side-icons"></i>
            Envios
          </li>
        </a>

        <a href="reportes.php">
          <li>
            <i class="ri-article-fill side-icons"></i>
            Reportes
          </li>
        </a>

        <a href="cerrarSesion.php">
          <li class="logout">
            <i class="ri-logout-box-r-line side-icons"></i>
            Cerrar Sesión
          </li>
        </a>
      </ul>
    </div>
    <div class="content-data">
      <div class="up-content">
        <div class="searchBar">
          <input type="text" id="search" placeholder="Buscar" />
          <i class="ri-search-line searchButton"></i>
        </div>
        <div class="user-name">
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario'];?></strong></h3>
        </div>
      </div>
      <div class="data">
        <div class="up-content">
          <h3>Total de empleados: <strong id="total"></strong></h3>
          <button type="button" id="nuevoCliente" class="startSession">
            Nuevo
          </button>
        </div>
        <div class="content-tables">
          <table class="tablaEmpleados" id="tablaEmpleados">
          </table>
        </div>
      </div>
    </div>
    <div id="miModal" class="modal">
      <div class="flex" id="flex">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-user-fill side-icons"></i>
            <h2>Nuevo Empleado</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Empleado" disabled/>
                <input type="text" placeholder="Ingrese el nombre"  id="nombre"/>
                <input type="text" placeholder="Ingrese la dirección" id="direccion"/>
                <select name="idJornada" id="idJornada"></select>
                <select name="idCargo" id="idCargo"></select>
                <input type="text" placeholder="Ingrese el correo"  id="correo"/>
                <input type="password" placeholder="Ingrese la contraseña" id="contrasena"/>
                <input type="password" placeholder="Confirme la Contraseña"  id="confirmnacion"/>
                
                <button type="button" onclick="registrarEmpleados()" class="guardarCliente">Guardar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoEmpleado.svg" alt="ilustracion" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="miModal2" class="modal">
      <div class="flex" id="flex2">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-user-fill side-icons"></i>
            <h2>Editar Empleado</h2>
            <span class="close" id="close2">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Empleado" id="idEmpleadoEditar" disabled/>
                <input type="text" placeholder="Ingrese el nombre"  id="nombreEditar"/>
                <input type="text" placeholder="Ingrese la dirección" id="direccionEditar"/>
                <select name="idJornada" id="idJornadaEditar"></select>
                <select name="idCargo" id="idCargoEditar"></select>
                <input type="text" placeholder="Ingrese el correo"  id="correoEditar"/>
                <input type="password" placeholder="Ingrese la contraseña" id="contrasenaEditar"/>
                <input type="password" placeholder="Confirme la Contraseña"  id="confirmacionEditar"/>
                <button type="button" onclick="editarEmpleado()" class="guardarCliente">Actualizar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoEmpleado.svg" alt="ilustracion" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="js/main.js"></script>
  </body>
</html>

<script type="text/javascript">
  (function(){
    obtenerEmpleados();
    obtenerJornadas();
    obtenerCargos();
    totalEmpleados();
  })();

  function limpiar() {
    var idCliente = document.getElementById("idJornadaEditar").value = "";
    var nombreCliente = document.getElementById("nombre").value = "";
    var telefono = document.getElementById("idJornada").value = "";
    var  direccion = document.getElementById("direccion").value = "";
    var idClienteEditar = document.getElementById("idEmpleadoEditar").value = "";
    //var nombreClienteEditar = document.getElementById("nombreClienteEditar").value = "";
    var telefonoEditar = document.getElementById("idCargoEditar").value = "";
    var direccionEditar = document.getElementById("direccionEditar").value = "";
  }

  function registrarEmpleados(){
    var nombreCliente = document.getElementById("nombre").value;
    var direccion = document.getElementById("direccion").value;
    var idJornada = document.getElementById("idJornada").value;
    var idCargo = document.getElementById("idCargo").value;
    var correo = document.getElementById("correo").value;
    var contrasena = document.getElementById("contrasena").value;
    var confirmacion = document.getElementById("confirmnacion").value;
    let tablaEmpleados = document.getElementById('tablaEmpleados');
    alert(contrasena);
    if(contrasena.trim() != confirmacion.trim()){
      alert("Contraseña no coincide con la confirmación");
    }
    else{
    $.post(
    "webservice/registrarEmpleados.php",
    {
      'nombre': nombreCliente,
      'direccion':direccion,
      'jornada': idJornada,
      'cargo': idCargo,
      'contrasena' : contrasena,
      'correo' : correo
    },
      function(data){
        alert(data);
        $Resp = JSON.parse(data);
        if($Resp.Ok==1){
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: $Resp.Data,
            showConfirmButton: false,
            timer: 1800
          })
          limpiar();
          totalEmpleados();
          tablaEmpleados.innerHTML = "";
          obtenerEmpleados();
          // window.location="dashboard.php";
        } else {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: $Resp.Data,
            showConfirmButton: false,
            timer: 1800
          })
        }
      }
    );

  }
  }

  $(document).on('keyup','#search',function(){
    var valor = $(this).val();
    let tablaEmpleados = document.getElementById('tablaEmpleados');
    if(valor != ""){
      tablaEmpleados.innerHTML ="";
      obtenerEmpleados(valor);


    }
    else{
      tablaEmpleados.innerHTML = "";
      obtenerEmpleados();
    }

    //Aqui va el codigo de busqueda
  });

  function obtenerEmpleados(valor) {
    let tablaEmpleados = document.getElementById('tablaEmpleados');

    $.post(
      "webservice/mostrarEmpleados.php",
      {
        'valor':valor
      },
      function(Data) {
        //alert(Data);
        let empleados = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Nombre</th><th>Dirección</th><th>Jornada</th><th>Cargo</th><th>Correo</th><th>Acciones</th></tr>";
        for(i in empleados) {
          html += "<tr><td>"+ empleados[i].idEmpleado +"</td><td>"+ empleados[i].nombre +"</td><td>"+ empleados[i].direccion +"</td><td>"+ empleados[i].idJornada +"</td><td>"+ empleados[i].idCargo+"</td><td>"+ empleados[i].correo +"</td><td><button id='editarEmpleado' class='btnEdit' onclick='obtenerId(this); mostrarEditar();' value="+ empleados[i].idEmpleado +">Editar</button><button class='btnDelete' id='eliminarEmpleado' onclick='obtenerIdEliminar(this);' value="+ empleados[i].idEmpleado +">Eliminar</button></td></tr>";
          tablaEmpleados.innerHTML = html;
        }
      }
    );
  }

  function obtenerJornadas() {
    let idJornada = document.getElementById('idJornada');
    let idJornadaEditar = document.getElementById('idJornadaEditar');

    $.post(
      "webservice/mostrarJornadas.php",
      {},
      function(Data) {
        let jornadas = JSON.parse(Data);
        html = "<option value='0'>Seleccione Jornada...</option>";
        for(i in jornadas) {
          html += "<option value="+ jornadas[i].idJornada +">"+ jornadas[i].descripcion +"</option>";
          idJornada.innerHTML = html;
          idJornadaEditar.innerHTML = html;
        }
      }
    );
  }

  function obtenerCargos() {
    let idCargo = document.getElementById('idCargo');
    let idCargoEditar = document.getElementById('idCargoEditar');

    $.post(
      "webservice/mostrarCargos.php",
      {},
      function(Data) {
        let cargos = JSON.parse(Data);
        html = "<option value='0'>Seleccione Cargo...</option>";
        for(i in cargos) {
          html += "<option value="+ cargos[i].idCargo +">"+ cargos[i].descripcion +"</option>";
          idCargo.innerHTML = html;
          idCargoEditar.innerHTML = html;
        }
      }
    );
  }

  function obtenerId(elemento) {
    let idEmpleado = document.getElementById('idEmpleadoEditar').value = elemento.value;
    buscarEmpleado(elemento.value);
  }

  function totalEmpleados() {
    let totalEmpleados = document.getElementById('total');

    $.post(
      "webservice/totalEmpleados.php",
      {},
      function(Data) {
        let total = JSON.parse(Data);
        totalEmpleados.innerHTML = total['totalEmpleados'];
      }
    );
  }
  
  function mostrarEditar() {
    let modal2 = document.getElementById('miModal2');
    let flex2 = document.getElementById('flex2');
    let abrir2 = document.getElementById('editarEmpleado');
    let cerrar2 = document.getElementById('close2');

    modal2.style.display = 'block';

    cerrar2.addEventListener('click', function(){
        modal2.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == flex2){
            modal.style.display = 'none';
        }
    });
  }

  function buscarEmpleado(idEmpleado) {
    $.post(
      "webservice/buscarEmpleado.php",
      {
        "idEmpleado": idEmpleado
      },
      function(Data) {
        let empleado = JSON.parse(Data);
        var nombreCliente = document.getElementById("nombreEditar").value = empleado['nombre'];
        var direccion = document.getElementById("direccionEditar").value = empleado['direccion'];
        var idJornada = document.getElementById("idJornadaEditar").value = empleado['idJornada'];
        var idCargo = document.getElementById("idCargoEditar").value = empleado['idCargo'];
      }
    );
  }

  function editarEmpleado() {
    var idEmpleado = document.getElementById('idEmpleadoEditar').value;
    var nombre = document.getElementById("nombreEditar").value;
    var direccion = document.getElementById("direccionEditar").value;
    var idJornada = document.getElementById("idJornadaEditar").value;
    var idCargo = document.getElementById("idCargoEditar").value;
    var contrasena = document.getElementById("contrasenaEditar").value;
    var confirmacion = document.getElementById('confirmacionEditar').value;
    let tablaEmpleados = document.getElementById('tablaEmpleados');
    
    $.post(
      "webservice/editarEmpleado.php",
      {
        "idEmpleado": idEmpleado,
        "nombre": nombre,
        "direccion": direccion,
        "idJornada": idJornada,
        "idCargo": idCargo,
        'contrasena' : contrasena,
        'correo' : correo
      },
      function(Data) {
        let notificacion = JSON.parse(Data);
        Swal.fire({
          icon: 'success',
          title: '¡Listo!',
          text: notificacion.Data
        });
        tablaEmpleados.innerHTML = "";
        obtenerEmpleados();
        // limpiar();
      }
    );
  }

  function obtenerIdEliminar(elemento) {
    var idEmpleado = document.getElementById('eliminarEmpleado').value = elemento.value;
    let tablaEmpleados = document.getElementById('tablaEmpleados');

    Swal.fire({
      title: '¿Estás seguro?',
      text: "Una vez eliminado el registro no podrás recuperarlo",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#b0b0b0',
      cancelButtonColor: '#a71d31',
      confirmButtonText: 'Si, deseo eliminarlo',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          "webservice/eliminarEmpleado.php",
          {
            "idEmpleado": idEmpleado
          }, 
          function(Data) {
            var notificacion = JSON.parse(Data);
            Swal.fire(
              '¡Hecho!',
              notificacion.Data,
              'success'
            )
            tablaEmpleados.innerHTML = "";
            obtenerEmpleados();
            totalEmpleados();
          }
        );
      }
    })
  }

</script>