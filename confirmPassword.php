<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/confirmPassword.css" />
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
          <h2>Recuperar Contraseña</h2>
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña">
          <i class="ri-lock-password-line icons cpassword"></i>
          <input type="password" name="confirmarContrasena" id="confirmarContrasena" placeholder="Confirmar contraseña">
          <button type="submit" class="startSession" >Guardar</button>
      </form>
    </section>
  </body>
  
  <?php 
    try {
      if (isset($_POST['contrasena'])) {
        $correo = $_SESSION['correo']; 
        $contraseña = $_POST['contrasena'];
        $confirmar = $_POST['confirmarContrasena'];
        $server = "localhost";
        $userbd = "root";
        $passbd = "";
        $db = "rapienvio";
        $conexion = mysqli_connect($server,$userbd,$passbd,$db);
        if($contraseña == $confirmar) {
          $encriptar = password_hash($contraseña, PASSWORD_DEFAULT);
          $sql = "UPDATE usuario SET contrasena='$encriptar' WHERE correo='$correo'";
          if ($conexion->query($sql) === TRUE) {
            echo '<script type="text/javascript">'
              , 'Swal.fire({
                position: "center",
                icon: "success",
                title: "Tu contraseña se ha modificado correctamente",
                showConfirmButton: false,
                timer: 1800
              })'
              , '</script>'
            ;
          } else {
            echo "Error modificando: " . $conexion->error;
          }
        }
      }
    } catch (\Throwable $th) {
      //throw $th;
    }
    
  ?>

  <script type="text/javascript">

  </script>
</html>