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
                <input type="text" placeholder="Ingrese la descripción"  id="descripcion"/>
                <input type="number" placeholder="Ingrese el peso" id="peso" />
                <input type="text" placeholder="Ingrese el casillero" id="casillero"/>
                <button type="button" onclick="registrarPaquete()" class="guardarCliente">Guardar</button>
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
                <button type="button" onclick="editarPaquete()" class="guardarCliente">Actualizar</button>
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

function registrarPaquete(){
  var descripcion = document.getElementById("descripcion").value;
  var peso = document.getElementById("peso").value;
  var casillero = document.getElementById("casillero").value;

  $.post(
    "webservice/agregarPaquete.php",
    {
      'descripcion': descripcion,
      'peso': peso,
      'casillero':casillero
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


</script>
