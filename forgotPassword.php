<?php session_start(); 
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/forgotPassword.css" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios - Inicia sesión o registrate</title>
  </head>
  <body>
    <header>
      <nav class="nav-bar">
        <a href="login.php"><img src="img/Logo2.png" alt="logo" id="logo" /></a>
      </nav>
    </header>
    <section class="content-data">
      <img id="cover" src="img/Ilustracion2.png" alt="cover">
      <form action="" method="post">
          <h2>Recuperar Contraseña</h2>
          <i class="ri-mail-line icons mail"></i>
          <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
          <button type="submit" class="startSession" >Enviar correo</button>
      </form>
    </section>
  </body>
  <?php

		try{
			if(isset($_POST['correo'])){
          $mail = $_POST['correo'];
          $server = "localhost";
          $userbd = "root";
          $passbd = "";
          $db = "rapienvio";

          if (!empty($mail)) {
            //Conecto
            $conexion = mysqli_connect($server,$userbd,$passbd,$db);
          
            $sql = "SELECT * FROM usuario WHERE correo='$mail'";
            $resultado = $conexion->query($sql);
            $row = $resultado->fetch_assoc();
            if ($row != null) {
              $_SESSION['correo'] = $mail;
              $to = $_POST['correo'];//"destinatario@email.com";
              $from = "From: " . "Rapienvios" ;
              $subject = "Recordar contraseña";
              $message .= "http://localhost/Rapienvios/confirmPassword.php";
  
              mail($to, $subject, $message, $from);
              echo '<script type="text/javascript">'
                  , 'Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Revisa tu correo",
                    text: "Hemos enviado un enlace para que puedas recuperar tu contraseña",
                    showConfirmButton: true
                  })'
                  , '</script>'
                ;
            } else if ($row == null) {
              echo '<script type="text/javascript">'
              , 'Swal.fire({
                position: "center",
                icon: "error",
                title: "Error",
                text: "Asegurate de utilizar un correo válido",
                showConfirmButton: true
              })'
              , '</script>'
            ;
            }
          } else {
            echo '<script type="text/javascript">'
              , 'Swal.fire({
                position: "center",
                icon: "warning",
                title: "Advertencia",
                text: "El campo contraseña no puede estar vacío",
                showConfirmButton: true
              })'
              , '</script>'
            ;
          }
          
      }

		}
		catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
            
  ?>

  <script type="text/javascript">

  </script>
</html>