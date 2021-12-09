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
        <li>
          <i class="ri-folder-user-fill side-icons"></i>
          <a href="dashboard.php">Clientes</a>
        </li>
        <li>
          <i class="ri-dropbox-fill side-icons"></i>
          <a href="paquetes.php">Paquetes</a>
        </li>
        <li class="active">
          <i class="ri-price-tag-3-fill side-icons"></i>
          <a href="#">Precios</a>
        </li>
        <li>
          <i class="ri-user-fill side-icons"></i>
          <a href="empleados.php">Empleados</a>
        </li>
        <li>
          <i class="ri-plane-fill side-icons"></i>
          <a href="envios.php">Envios</a>
        </li>
        <a href="reportes.php">
          <li class="">
            <i class="ri-article-fill side-icons"></i>
            Reportes
          </li>
        </a>
        <li class="logout">
          <i class="ri-logout-box-r-line side-icons"></i>
          <a href="cerrarSesion.php">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
    <div class="content-data">
      <div class="up-content">
        <div class="searchBar">
          <input type="text" id="search" placeholder="Buscar" />
          <i class="ri-search-line searchButton"></i>
        </div>
        <div class="user-name">
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario'] ; ?></strong></h3>
        </div>
      </div>
      <div class="data">
        <div class="up-content">
          <h3>Total de Registros: <strong id="total"></strong></h3>
          <button type="button" id="nuevoCliente" class="startSession">
            Actualizar P.
          </button>
        </div>
        <div class="content-tables">
          <table class="tablaClientes" id="tablaClientes">
          </table>
        </div>
      </div>
    </div>
    <div id="miModal" class="modal">
      <div class="flex" id="flex">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-folder-user-fill side-icons"></i>
            <h2>Nuevo Precio de Casillero</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Historial" disabled/>
                <!--<input type="text" placeholder="Ingrese el casillero"  id="idCasillero"/>-->
                <select name="idTipoCasillero" id="idTipoCasillero"></select>
                <input type="text" placeholder="Ingrese el precio" id="precio"/>
                <button type="button" onclick="registrarPrecio()" class="guardarCliente">Guardar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoCliente.svg" alt="ilustracion" />
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
            <i class="ri-folder-user-fill side-icons"></i>
            <h2>Editar Precio</h2>
            <span class="close" id="close2">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Historial" disabled/>
                <!--<input type="text" placeholder="Ingrese el casillero"  id="idCasillero"/>-->
                <select name="idTipoCasillero" id="idTipoCasillero"></select>
                <input type="text" placeholder="Ingrese el precio" id="precio"/>
                <button type="button" onclick="editarPrecio()" class="guardarCliente">Actualizar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoCliente.svg" alt="ilustracion" />
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
    obtenerClientes();
    totalClientes();
    obtenerTipoCasilleros();
  })();

  function limpiar() {
    //var idCliente = document.getElementById("idCliente").value = "";
    var nombreCliente = document.getElementById("nombreCliente").value = "";
    var telefono = document.getElementById("telefono").value = "";
    var  direccion = document.getElementById("direccion").value = "";
    var idClienteEditar = document.getElementById("idClienteEditar").value = "";
    var nombreClienteEditar = document.getElementById("nombreClienteEditar").value = "";
    var telefonoEditar = document.getElementById("telefonoEditar").value = "";
    var direccionEditar = document.getElementById("direccionEditar").value = "";
  }

  function obtenerTipoCasilleros(){
    var casillero = document.getElementById("idTipoCasillero");

    $.post(
      "webservice/mostrarTamanios.php",
      {},
      function(Data) {
        //alert(Data);
        let cargos = JSON.parse(Data);
        html = "<option value='0'>Seleccione Casillero...</option>";
        for(i in cargos) {
          html += "<option value="+ cargos[i].idTamanio +">"+ cargos[i].descripcion +"</option>";
          casillero.innerHTML = html;
          //idCargoEditar.innerHTML = html;
        }
      }
    );


  }

  function registrarPrecio(){
    var nombreCliente = document.getElementById("idTipoCasillero").value;
    var telefono = document.getElementById("precio").value;
    //var  direccion = document.getElementById("direccion").value;
    let tablaClientes = document.getElementById('tablaClientes');

    $.post(
    "webservice/agregarPrecioCasillero.php",
    {
      'idTipoCasillero': nombreCliente,
      'precio': telefono
    },
      function(data){
        //alert(data);
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
          totalClientes();
          tablaClientes.innerHTML = "";
          obtenerClientes();
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

  function obtenerClientes() {
    let tablaClientes = document.getElementById('tablaClientes');

    $.post(
      "webservice/mostrarPrecioCasillero.php",
      {},
      function(Data) {
        //alert(Data);
        let clientes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Tipo de Casillero</th><th>Fecha de Inicio</th><th>Fecha de Finalizacion</th><th>Precio</th></tr>";
        for(i in clientes) {
          var aux = clientes[i].fechaInicio.split('-');
          //alert(aux);
          html += "<tr><td>"+ clientes[i].idHistorial +"</td><td>"+ clientes[i].idCasillero +"</td><td>"+ aux[2]+'/'+aux[1]+'/'+aux[0] +"</td><td>"+ clientes[i].fechaFinal +"</td><td>"+ clientes[i].precio +"</td></tr>";
          tablaClientes.innerHTML = html;
        }
      }
    );
  }

  function obtenerId(elemento) {
    let idCliente = document.getElementById('idClienteEditar').value = elemento.value;
    buscarCliente(idCliente);
    if(idCliente == 2){
      mostrarEditar();
    }
  }

  function totalClientes() {
    let totalClientes = document.getElementById('total');

    $.post(
      "webservice/totalPrecioCasillero.php",
      {},
      function(Data) {
        //alert(Data);
        let total = JSON.parse(Data);
        totalClientes.innerHTML = total['total'];
      }
    );
  }
  
  function mostrarEditar() {
    let modal2 = document.getElementById('miModal2');
    let flex2 = document.getElementById('flex2');
    let abrir2 = document.getElementById('editarCliente');
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

  function buscarCliente(idCliente) {
    $.post(
      "webservice/buscarCliente.php",
      {
        "idCliente": idCliente
      },
      function(Data) {
        let clientes = JSON.parse(Data);
        var nombreCliente = document.getElementById("nombreClienteEditar").value = clientes['nombre'];
        var telefono = document.getElementById("telefonoEditar").value = clientes['telefono'];
        var  direccion = document.getElementById("direccionEditar").value = clientes['direccion'];
      }
    );
  }

  function editarCliente() {
    var idCliente = document.getElementById('idClienteEditar').value;
    var nombreCliente = document.getElementById("nombreClienteEditar").value;
    var telefono = document.getElementById("telefonoEditar").value;
    var direccion = document.getElementById("direccionEditar").value;
    let tablaClientes = document.getElementById('tablaClientes');
    
    $.post(
      "webservice/editarCliente.php",
      {
        "idCliente": idCliente,
        "nombre": nombreCliente,
        "telefono": telefono,
        "direccion": direccion
      },
      function(Data) {
        let notificacion = JSON.parse(Data);
        Swal.fire({
          icon: 'success',
          title: '¡Listo!',
          text: notificacion.Data
        });
        tablaClientes.innerHTML = "";
        obtenerClientes();
        limpiar();
      }
    );
  }

  function obtenerIdEliminar(elemento) {
    var idCliente = document.getElementById('eliminarCliente').value = elemento.value;
    let tablaClientes = document.getElementById('tablaClientes');

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
          "webservice/eliminarCliente.php",
          {
            "idCliente": idCliente
          }, 
          function(Data) {
            var notificacion = JSON.parse(Data);
            Swal.fire(
              '¡Hecho!',
              notificacion.Data,
              'success'
            )
            tablaClientes.innerHTML = "";
            obtenerClientes();
            totalClientes();
          }
        );
      }
    })
  }

</script>