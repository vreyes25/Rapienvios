<?php
Session_start();

if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''){
  header('Location:login.php');
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
      <hr class="side-nav-hr">
      <ul class="dashboard-elements">

        <a href="dashboardClientes.php">
          <li class="active">
            <i class="ri-archive-fill side-icons"></i>
            Mis Paquetes
          </li>
        </a>

      


        <a href="preciosClientes.php">
          <li>
            <i class="ri-price-tag-3-fill side-icons"></i>
            Consultar Precios
          </li>
        </a>

        <a href="cuentaCliente.php">
          <li>
            <i class="ri-settings-3-fill side-icons"></i>
            Mi Cuenta
          </li>
        </a>
      </ul>


      <ul class="logout-container">
        <a href="cerrarSesion2.php">
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
          <input type="text" id="search" placeholder="Buscar paquete" />
          <i class="ri-search-line searchButton"></i>
        </div>
        <div class="user-name">
          <h3>Bienvenido, <strong><?php echo $_SESSION['usuario'];?></strong></h3>
        </div>
      </div>

      <div class="data">

        <div class="data-container-paquetes">
          <div class="up-content" style="margin-left:0;">
            <h3>Total de paquetes: <strong>0</strong></h3>
          </div>

          <div class="up-content" style="margin-right:0;">
            <h3>Total de envios: <strong>0</strong></h3>
          </div>
        </div>


        <div class="tabla-paquetes">
          <table class="tablaPaquetes" id="tablaPaquetes">
          </table>
        </div>

        
        <div class="tabla-envios">
          <table class="tablaEnvios" id="tablaEnvios"></table>
        </div>


        <div class="content-tables"></div>
      </div>
      
    </div>

    <div id="modalTracking" class="modal">
      <div class="flex" id="flex">
        <div class="contenido-modal">
          <div class="modal-header flex">
            <i class="ri-folder-user-fill side-icons"></i>
            <h2>Tracking</h2>
            <span class="close" id="closer">&times;</span>
          </div>
          <div class="modal-body modal-tracking">
            <form action="" method="post" class="nuevoCliente">
              <div class="form" style="display:grid; gap:2rem;">
                <h4 style="grid-column:1/1">
                  ID Tracking:
                </h4>
                <p style="grid-column:2/2">3496846346134</p>
                <h4 style="grid-column:1/1">
                  Fecha Llegada:
                </h4>
                <p style="grid-column:2/2">16/12/22</p>
                <h4 style="grid-column:1/1">
                  Fecha Salida:
                </h4>
                <p style="grid-column:2/2">28/12/22</p>
                <h4 style="grid-column:1/1">
                  Ubicación:
                </h4>
                <p style="grid-column:2/2">Tangamandapio</p>
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
    obtenerPaquetes();
    obtenerEnvios();
    EstadoEdit();
  })();
  
  function obtenerPaquetes(valor) {
    let tablaPaquetes = document.getElementById('tablaPaquetes');

    $.post(
      "webservice/mostrarPaquetes.php",
      {'valor':valor},
      function(Data) {
        let paquetes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>Descripción</th><th>Peso</th></tr>";
        for(i in paquetes) {
          html += "<tr id='idTr'><td id='idPaquete"+i+"'>"+ paquetes[i].idPaquete +"</td><td>"+ paquetes[i].descripcion +"</td><td>"+ paquetes[i].peso;
          tablaPaquetes.innerHTML = html;
        }
      }
    );
  }

  function obtenerEnvios(valor) {
    let tablaClientes = document.getElementById('tablaEnvios');

    $.post(
      "webservice/mostrarEnviosActivos.php",
      {
        'valor':valor
      },
      function(Data) {
        //alert(Data);
        let clientes = JSON.parse(Data);
        html = "<tr><th>ID</th><th>fecha Envio</th><th>Estado</th><th>Acciones</th></tr>";
        for(i in clientes) {
          html += "<tr><td>"+ clientes[i].idEnvio +"</td><td>"+ clientes[i].fechaEnvio +"</td><td>"+ clientes[i].estado +"</td><td><button class='btnDelete' id='eliminarCliente' onclick='mostrarTracking();' value="+ clientes[i].idEnvio +">Mostrar Tracking</button></td></tr>";
          tablaClientes.innerHTML = html;
        }
      }
    );
  }
  
  function EstadoEdit() {
    var id = document.getElementById("idTr");
    console.log(id);
  }
  function mostrarTracking() {
    let modal2 = document.getElementById('modalTracking');
    let flex2 = document.getElementById('flex');
    let abrir2 = document.getElementById('eliminarCliente');
    let cerrar2 = document.getElementById('closer');

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
</script>
