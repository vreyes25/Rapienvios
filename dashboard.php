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
          <li class="active">
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

        <a href="precios.php">
          <li>
            <i class="ri-price-tag-3-fill side-icons"></i>
            Precios
          </li>
        </a>

        <a href="empleados.php">
          <li>
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
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong></h3>
        </div>
      </div>
      <div class="data">
        <div class="up-content">
          <h3>Total de clientes: <strong id="total"></strong></h3>
          <button type="button" id="nuevoCliente" class="startSession">
            Nuevo
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
            <h2>Nuevo Cliente</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Cliente" disabled/>
                <input type="text" placeholder="Ingrese el nombre"  id="nombreCliente"/>
                <input type="text" placeholder="Ingrese el teléfono" id="telefono" />
                <input type="text" placeholder="Ingrese la dirección" id="direccion"/>
                <button type="button" onclick="registrarCliente()" class="guardarCliente">Guardar</button>
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
            <h2>Editar Cliente</h2>
            <span class="close" id="close2">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Cliente" id="idClienteEditar" disabled/>
                <input type="text" placeholder="Ingrese el nombre"  id="nombreClienteEditar"/>
                <input type="text" placeholder="Ingrese el teléfono" id="telefonoEditar" />
                <input type="text" placeholder="Ingrese la dirección" id="direccionEditar"/>
                <button type="button" onclick="editarCliente()" class="guardarCliente">Actualizar</button>
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

  function registrarCliente(){
    var nombreCliente = document.getElementById("nombreCliente").value;
    var telefono = document.getElementById("telefono").value;
    var  direccion = document.getElementById("direccion").value;
    let tablaClientes = document.getElementById('tablaClientes');

    $.post(
    "webservice/registrarCliente.php",
    {
      'nombre': nombreCliente,
      'telefono': telefono,
      'direccion':direccion
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
      "webservice/mostrarClientes.php",
      {},
      function(Data) {
        //alert(Data);
        let clientes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Dirección</th><th>Estado</th><th>Acciones</th></tr>";
        for(i in clientes) {
          html += "<tr><td>"+ clientes[i].idCliente +"</td><td>"+ clientes[i].nombre +"</td><td>"+ clientes[i].telefono +"</td><td>"+ clientes[i].direccion +"</td><td>"+ clientes[i].idEstado +"</td><td><button id='editarCliente' class='btnEdit' onclick='obtenerId(this); mostrarEditar();' value="+ clientes[i].idCliente +">Editar</button><button class='btnDelete' id='eliminarCliente' onclick='obtenerIdEliminar(this);' value="+ clientes[i].idCliente +">Eliminar</button></td></tr>";
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
      "webservice/totalClientes.php",
      {},
      function(Data) {
        let total = JSON.parse(Data);
        totalClientes.innerHTML = total['totalClientes'];
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