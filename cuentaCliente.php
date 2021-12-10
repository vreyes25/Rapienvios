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
    <link rel="stylesheet" href="css/cuentaCliente.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <div class="decoration-line"></div>
      <ul class="dashboard-elements">

        <a href="dashboardClientes.php">
          <li>
            <i class="ri-archive-fill side-icons"></i>
            Mis Paquetes
          </li>
        </a>

        <a href="tracking.php">
          <li>
            <i class="ri-truck-fill side-icons"></i>
            Tracking
          </li>
        </a>


        <a href="preciosClientes.php">
          <li>
            <i class="ri-price-tag-3-fill side-icons"></i>
            Consultar Precios
          </li>
        </a>

        <a href="cuentaCliente.php">
          <li class="active">
            <i class="ri-settings-3-fill side-icons"></i>
            Mi Cuenta
          </li>
        </a>

        <li class="logout">
          <i class="ri-logout-box-r-line side-icons"></i>
          <a href="cerrarSesion2.php">Cerrar Sesión</a>
        </li>

      </ul>
    </div>
    <div class="content-data">
    <div class="testbox">
      <form action="/">
        <h1>Información de Cuenta</h1>
        <hr/>
        <div class="item">
          <p>Nombre</p>
          <input type="text" name="nombre" id="nombre" value="<?php echo $_SESSION['usuario']?>"/>
        </div>
        <div class="item">
          <p>Teléfono</p>
          <input type="text" name="telefono" id="telefono"/>
        </div>
        <div class="item address">
          <p>Dirección</p>
          <div class="complaint-details-item">
            <textarea rows="2" id="direccion"></textarea>
          </div>
        </div>
        <div class="item">
          <p>Correo</p>
          <input type="email" name="correo" id="correo" disabled/>
        </div>
        <div class="item complaint-details">
          <p>Casillero</p>
          <select name="casilleros" id="casilleros"></select>
        </div>
        <div class="btn-block">
          <button type="button" onclick="actualizarInfo();">Actualizar Datos</button>
        </div>
      </form>
        <form class="cambiarClave" action="/">
          <h1>Cambiar Contraseña</h1>
          <hr/>
          <div class="item">
            <p>Contraseña Nueva</p>
            <input type="password" name="contrasenaNueva" id="contrasenaNueva" />
          </div>
          <div class="item">
            <p>Confirmar Contraseña</p>
            <input type="password" name="confirmarContrasena" id="confirmarContrasena"/>
          </div>
          <div class="btn-block">
            <button type="button" onclick="cambiarContrasena();">Actualizar</button>
          </div>
        </form>
    </div>
        </div>
      </div>
    </div>

  </body>
</html>

<script type="text/javascript">
  (function(){
    infoCuentaCliente();
    cargarCasilleros();
  })();

  function infoCuentaCliente () {
    let nombre = document.getElementById('nombre').value;
    $.post(
      "webservice/buscarClienteData.php",
      {
        "nombre": nombre
      },
      function(Data) {
        console.log(Data);
        let clientes = JSON.parse(Data);
        document.getElementById("telefono").value = clientes['telefono'];
        document.getElementById("direccion").value = clientes['direccion'];
        document.getElementById("correo").value = clientes['correo'];
        document.getElementById("casilleros").value = clientes['idCasillero'];  
      }
    );
  }

  function actualizarInfo() {
    var nombre = document.getElementById('nombre').value;
    var correo = document.getElementById('correo').value;
    var telefono = document.getElementById('telefono').value;
    var direccion = document.getElementById('direccion').value;
    var casilleros = document.getElementById('casilleros').value;
    
    $.post(
      "webservice/editarClienteData.php",
      {
        "correo": correo,
        "nombre": nombre,
        "telefono": telefono,
        "direccion": direccion,
        'idCasillero': casilleros
      },
      function(Data) {
        alert(Data);
        let notificacion = JSON.parse(Data);
        Swal.fire({
          icon: 'success',
          title: '¡Listo!',
          text: notificacion.Data
        });
        infoCuentaCliente();
      }
    );
  }
  
  function cargarCasilleros () {
    let casilleros = document.getElementById('casilleros');
    $.post(
      "webservice/mostrarCasillerosDetalle.php",
      {},
      function(Data){
        let casillero = JSON.parse(Data);
        html = "<option value='0'>Seleccione casillero...</option>"
        for(i in casillero) {
          html += "<option value="+ casillero[i].idCasillero +">"+ casillero[i].idTamanio +"</option>";
        }
        casilleros.innerHTML = html;
      }
    );
  }

  function cambiarContrasena () {
    let nombre = document.getElementById('nombre').value;
    let contrasenaNueva = document.getElementById('contrasenaNueva').value;
    let confirmarContrasena = document.getElementById('confirmarContrasena').value;
    if (contrasenaNueva == "" || confirmarContrasena == "") {
      Swal.fire({
        icon: 'warning',
        title: 'Advertencia',
        text: 'Debes llenar ambos campos para poder actualizar la contraseña'
      });
    } else if (contrasenaNueva != confirmarContrasena) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden'
      });
    } else {
      $.post(
        "webservice/cambiarContrasena.php",
        {
          "nombre": nombre,
          "contrasena": contrasenaNueva
        },
        function(Data) {
          let cliente = JSON.parse(Data);
          if (cliente.Ok == "1") {
            Swal.fire({
              icon: 'success',
              title: '¡Listo!',
              text: cliente.Data
            });
            document.getElementById('contrasenaNueva').value = "";
            document.getElementById('confirmarContrasena').value = "";
          } else if (cliente.Ok == "0") {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: cliente.Data
            });
          }
        }
      );
    }
  }

</script>
