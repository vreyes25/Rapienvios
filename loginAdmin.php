<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/loginAdmin.css" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios - Inicia sesión o registrate</title>
  </head>
  <body>
    <header>
      <nav class="nav-bar">
        <a href="index.php"><img src="img/Logo2.png" alt="logo" id="logo" /></a>
      </nav>
    </header>
    <section class="content-data">
      <img id="cover" src="img/IlustracionAdmin.png" alt="cover">
      <form action="" method="post">
          <h2>BIENVENIDO AL SISTEMA</h2>
          <i class="ri-mail-line icons user"></i>
          <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">
          <button type="button" onclick="iniciarSesion()" class="startSession" >Iniciar Sesión</button>
      </form>
    </section>
  </body>


  <script type="text/javascript">

function iniciarSesion(){
  var correo = document.getElementById("correo").value;
  var contrasena = document.getElementById("contrasena").value;

  $.post(
    "webservice/loginAdmin.php",
    {
      'correo': correo,
      'contrasena': contrasena
    },
      function(data){
        //alert(data);
        $Resp = JSON.parse(data);
        if($Resp.Ok==1){
          window.location="dashboard.php";
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
</html>