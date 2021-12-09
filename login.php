<?php
Session_start();
session_destroy();


?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
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
      <img id="cover" src="img/Ilustracion2.png" alt="cover">
      <form action="" method="post">
          <h2>BIENVENIDO</h2>
          <i class="ri-user-line icons user"></i>
          <input type="text" name="nombre" id="username" placeholder="Ingrese su usuario">
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="contrasena" id="password" placeholder="Ingrese su contraseña">
          <a class="forgot" href="forgotPassword.php">¿Olvidaste tu contraseña?</a>
          <button type="button" onclick="iniciarSesion()" class="startSession" >Iniciar Sesión</button>
          <p>¿No tienes una cuenta? <a href="registration.php">Registrate</a></p>
      </form>
    </section>
  </body>


  <script type="text/javascript">

function iniciarSesion(){
  var usuario = document.getElementById("username").value;
  var contrasena = document.getElementById("password").value;

  $.post(
    "webservice/login.php",
    {
      'usuario': usuario,
      'contrasena': contrasena
    },
      function(data){
        //alert(data);
        $Resp = JSON.parse(data);
        if($Resp.Ok==1){
          window.location="dashboardClientes.php";
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