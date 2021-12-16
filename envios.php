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
    <link rel="stylesheet" href="css/dashboardEnvio.css" />
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
          <li>
            <i class="ri-user-fill side-icons"></i>
            Empleados
          </li>
        </a>

        <a href="#">
          <li class="active">
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
          <h3>Total de Envios Pendientes: <strong id="total"></strong></h3>
          <button type="button" id="" class="">
            
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
            <h2>Información del Envio</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body2">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">          
              <label for="">ID Envio:    </label> <input type="text" placeholder="ID Envio" id="abcd" disabled/> 
                <label for="nombreCliente">ID Paquete:</label><input type="text" placeholder="ID Paquete"  id="nombreCliente" disabled/> 
                <label for="paquete">Descripción:</label>  <input type="text" placeholder="Descripcion " id="paquete" disabled/>
                <label for="cliente">Cliente:</label> <input type="text" placeholder="Cliente" id="cliente" disabled/>
                <label for="Residencia">Residencia del Cliente:</label>   <input type="text" placeholder="Residencia del cliente" id="Residencia" disabled/>
                <label for="Telefono">Telefono:</label><input type="text" placeholder="Telefono del ciente" id="Telefono" disabled/>
                <label for="Ubicacion">Ubicacion Actual del Paquete:</label> <input type="text" placeholder="Ubicacion actual del paquete" id="Ubicacion" disabled/>
                
                <!--<button type="button" onclick="registrarCliente()" class="guardarCliente">Guardar</button>-->
              </div>
              <!--<div class="imagen">
                <img src="img/nuevoCliente.svg" alt="ilustracion" />
              </div>-->
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
            <h2>Actualizar Ubicación Paquete</h2>
            <span class="close" id="close2">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="Tracking Id" id="idClienteEditar" disabled/>
                <input type="text" placeholder="ID Paquete"  id="nombreClienteEditar" disabled/>
                <input type="text" placeholder="Ubicacion Actual" id="telefonoEditar" />
                <!--<input type="text" placeholder="Ingrese la dirección" id="direccionEditar"/>-->
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

    <!--<script src="js/main.js"></script>-->
    <!--<script src="js/mainInf.js"></script>-->
  </body>
</html>

<script type="text/javascript">
  (function(){
    obtenerClientes();
    totalClientes();
    //mostrarInfo();
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

  $(document).on('keyup','#search',function(){
    var valor = $(this).val();
    let tablaEmpleados = document.getElementById('tablaClientes');
    if(valor != ""){
      tablaEmpleados.innerHTML ="";
      obtenerClientes(valor);


    }
    else{
      tablaEmpleados.innerHTML = "";
      obtenerClientes();
    }

    //Aqui va el codigo de busqueda
  });


  function obtenerClientes(valor) {
    let tablaClientes = document.getElementById('tablaClientes');

    $.post(
      "webservice/mostrarEnviosActivos.php",
      {
        'valor':valor
      },
      function(Data) {
        //alert(Data);
        let clientes = JSON.parse(Data);
        html = "<tr><th>Inf</th><th>ID</th><th>ID Paquete</th><th>ID de Empleado</th><th>Fecha Recibido</th><th>fecha Envio</th><th>Estado</th><th>Acciones</th></tr>";
        for(i in clientes) {
          html += "<tr></td><td><button id='inf' class='btnEdit' onclick='mostrarInfo(this)' value="+ clientes[i].idPaquete +">Inf.</button><td>"+ clientes[i].idEnvio +"</td><td>"+ clientes[i].idPaquete +"</td><td>"+ clientes[i].idEmpleado +"</td><td>"+ clientes[i].fechaRecibido +"</td><td>"+ clientes[i].fechaEnvio +"</td><td>"+ clientes[i].estado +"</td><td><button id='editarCliente' class='btnEdit' onclick='obtenerId(this); mostrarEditar();' value="+ clientes[i].idPaquete +">Actualizar</button><button class='btnDelete' id='eliminarCliente' onclick='obtenerIdEliminar(this);' value="+ clientes[i].idEnvio+'-'+clientes[i].idPaquete +">Recibido</button></td></tr>";
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
      "webservice/totalEnviosPendiente.php",
      {},
      function(Data) {
        //alert(Data);
        let total = JSON.parse(Data);
        totalClientes.innerHTML = total;
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

  function mostrarInfo(elemento){
    let modal = document.getElementById('miModal');
    let flex = document.getElementById('flex');
    let abrir = document.getElementById('inf');
    let cerrar = document.getElementById('close');

    
        modal.style.display = 'block';
    

    cerrar.addEventListener('click', function(){
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(e){
        console.log(e.target);
        if(e.target == flex){
            modal.style.display = 'none';
        }
    });


    //alert(elemento.value);

    $.post(
      "webservice/mostrarInformacionEnvio.php",
      {
        "idPaquete":elemento.value
      },
      function(Data){
        //alert(Data);
        let cliente = JSON.parse(Data);
        document.getElementById("abcd").value = cliente['idEnvio'];
        document.getElementById("nombreCliente").value = cliente['idPaquete'];
        document.getElementById("paquete").value = cliente['descripcion'];
        document.getElementById("cliente").value = cliente['cliente'];
        document.getElementById("Residencia").value = cliente['direccion'];
        document.getElementById("Telefono").value = cliente['telefono'];
        document.getElementById("Ubicacion").value = cliente['ubicacion'];
      }

    );
    //Post con la adquisicion de datos


  }

  function buscarCliente(idCliente) {
    $.post(
      "webservice/buscarTrackingEnvio.php",
      {
        "idCliente": idCliente
      },
      function(Data) {
        //alert(Data);
        let clientes = JSON.parse(Data);
        var nombreCliente = document.getElementById("nombreClienteEditar").value = clientes['TrackingId'];
        var telefono = document.getElementById("telefonoEditar").value = clientes['idInventario'];
        var  direccion = document.getElementById("telefonoEditar").value = "";
      }
    );
  }

  function editarCliente() {
    var idCliente = document.getElementById('idClienteEditar').value; //idPaquete
    var nombreCliente = document.getElementById("nombreClienteEditar").value;//idTracking
    var telefono = document.getElementById("telefonoEditar").value;
    //var direccion = document.getElementById("direccionEditar").value;
    let tablaClientes = document.getElementById('tablaClientes');
    //alert(nombreCliente);

    $.post(
      "webservice/ActualizarUbicacionPorEnvio.php",
      {
        "trackingId": nombreCliente,
        "idPaquete": idCliente,
        "Ubicacion": telefono
        
      },
      function(Data) {
        //alert(Data);
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
    //alert(elemento);
    var auxiliar = elemento.value.toString().split('-');
    //alert(auxiliar);
    var idCliente = document.getElementById('eliminarCliente').value = parseInt(auxiliar[0]);
    let tablaClientes = document.getElementById('tablaClientes');
    //alert(idCliente);
    var paquete = parseInt(auxiliar[1]);
    //alert(paquete);
    Swal.fire({
      title: '¿Estás seguro?',
      text: "Una vez Marcado como Entregado el envio no podrás Desmarcarlo",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#b0b0b0',
      cancelButtonColor: '#a71d31',
      confirmButtonText: 'Si, deseo Marcar como Entregado',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          "webservice/entregarEnvio.php",
          {
            "idEnvio": idCliente,
            "paquete": paquete
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