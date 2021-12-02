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
        <li class="active">
          <i class="ri-dropbox-fill side-icons"></i>
          <a href="#">Paquetes</a>
        </li>
        <li>
          <i class="ri-price-tag-3-fill side-icons"></i>
          <a href="precios.php">Precios</a>
        </li>
        <li>
          <i class="ri-user-fill side-icons"></i>
          <a href="empleados.php">Empleados</a>
        </li>
        <li class="logout">
          <i class="ri-logout-box-r-line side-icons"></i>
          <a href="index.php">Cerrar Sesión</a>
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
          <h3>Bienvenido, <strong>Victor Reyes</strong></h3>
        </div>
      </div>
      <div class="data">
        <div class="up-content">
          <h3>Total de paquetes: <strong id="total"></strong></h3>
          <button type="button" id="nuevoCliente" class="startSession">
            Nuevo
          </button>
        </div>
        <div class="content-tables">
          <table class="tablaPaquetes" id="tablaPaquetes">
            <tr>
              <th>ID</th>
              <th>Descripción</th>
              <th>Peso</th>
              <th>ID Casillero</th>
              <th>Acciones</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div id="miModal" class="modal">
      <div class="flex" id="flex">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-folder-user-fill side-icons"></i>
            <h2>Nuevo Paquete</h2>
            <span class="close" id="close">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">
                <input type="text" placeholder="ID Paquete" disabled/>

                <input type="text" placeholder="Ingrese la descripcion"  id="descripcion"/>
                <input type="text" placeholder="Ingrese el peso" id="peso" />
                <select name="idCasillero" id="idCasillero"></select>

                <button type="button" onclick="registrarPaquete()" class="guardarCliente">Guardar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoPaquete.svg" alt="ilustracion" />
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
            <h2>Editar Paquete</h2>
            <span class="close" id="close2">&times;</span>
          </div>
          <div class="modal-body">
            <form action="" method="post" class="nuevoCliente">
              <div class="form">

                <input type="text" placeholder="ID Paquete" id="idPaqueteEditar" disabled/>
                <input type="text" placeholder="Ingrese la descripción"  id="descripciónEditar"/>
                <input type="text" placeholder="Ingrese el peso" id="pesoEditar" />
                <select name="idCasilleroEditar" id="idCasilleroEditar"></select>

                <button type="button" onclick="editarPaquete()" class="guardarCliente">Actualizar</button>
              </div>
              <div class="imagen">
                <img src="img/nuevoPaquete.svg" alt="ilustracion" />
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
    totalPaquetes();
    obtenerPaquetes();
    obtenerCasilleros();
  })();


function editarPaquete(){
  var idPaquete = document.getElementById("idPaqueteEditar").value;
  var descripcion = document.getElementById("descripciónEditar").value;
  var peso = document.getElementById("pesoEditar").value;
  var casillero = document.getElementById("idCasilleroEditar").value;

  $.post(
    "webservice/editarPaquete.php",
    {
      'idPaquete' : idPaquete,
      'descripcion': descripcion,
      'peso': peso,
      'casillero':casillero
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
          //limpiar();
          //totalClientes();
          //tablaClientes.innerHTML = "";
          //obtenerClientes();
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

function registrarPaquete(){
  var descripcion = document.getElementById("descripcion").value;
  var peso = document.getElementById("peso").value;
  var casillero = document.getElementById("idCasillero").value;

  $.post(
    "webservice/agregarPaquete.php",
    {
      'descripcion': descripcion,
      'peso': peso,
      'casillero':casillero
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
          //limpiar();
          //totalClientes();
          //tablaClientes.innerHTML = "";
          //obtenerClientes();
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

  function totalPaquetes() {
    let totalPaquetes = document.getElementById('total');

    $.post(
      "webservice/totalPaquetes.php",
      {},
      function(Data) {
        let total = JSON.parse(Data);
        totalPaquetes.innerHTML = total['totalPaquetes'];
      }
    );
  }

  


  function mostrarEditar() {
    let modal2 = document.getElementById('miModal2');
    let flex2 = document.getElementById('flex2');
    let abrir2 = document.getElementById('editarPaquete');
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

  function obtenerPaquetes() {
    let tablaPaquetes = document.getElementById('tablaPaquetes');

    $.post(
      "webservice/mostrarPaquetes.php",
      {},
      function(Data) {
        let paquetes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Descripción</th><th>Peso</th><th>ID Casillero</th><th>Acciones</th></tr>";
        for(i in paquetes) {
          html += "<tr><td>"+ paquetes[i].idPaquete +"</td><td>"+ paquetes[i].descripcion +"</td><td>"+ paquetes[i].peso +"</td><td>"+ paquetes[i].idCasillero +"</td><td><button id='editarPaquete' class='btnEdit' onclick='obtenerId(this); mostrarEditar();' value="+ paquetes[i].idPaquete +">Editar</button><button class='btnDelete' id='eliminarPaquete' onclick='obtenerIdEliminar(this);' value="+ paquetes[i].idPaquete +">Eliminar</button></td></tr>";
          tablaPaquetes.innerHTML = html;
        }
      }
    );
  }

  function obtenerCasilleros() {
    let idCasillero = document.getElementById('idCasillero');
    let idCasilleroEditar = document.getElementById('idCasilleroEditar');

    $.post(
      "webservice/mostrarCasilleros.php",
      {},
      function(Data) {
        let casilleros = JSON.parse(Data);
        html = "<option value='0'>Seleccione Casillero...</option>";
        for(i in casilleros) {
          html += "<option value="+ casilleros[i].idCasillero +">"+ casilleros[i].idCasillero +"</option>";
          idCasillero.innerHTML = html;
          idCasilleroEditar.innerHTML = html;
        }
      }
    );
  }

  function obtenerIdEliminar(elemento) {
    var idCliente = document.getElementById('eliminarPaquete').value = elemento.value;
    let tablaClientes = document.getElementById('tablaPaquetes');

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
          "webservice/eliminarPaquete.php",
          {
            "idPaquete": idCliente
          }, 
          function(Data) {
            var notificacion = JSON.parse(Data);
            Swal.fire(
              '¡Hecho!',
              notificacion.Data,
              'success'
            )
            tablaClientes.innerHTML = "";
            //obtenerClientes();
            //totalClientes();
          }
        );
      }
    })
  }

  function obtenerId(elemento) {
    let idPaquete = document.getElementById('idPaqueteEditar').value = elemento.value;
    // buscarEmpleado(elemento.value);
  }

</script>