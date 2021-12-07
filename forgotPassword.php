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
        <a href="index.php"><img src="img/Logo2.png" alt="logo" id="logo" /></a>
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
			if(isset($_POST['correo']) && !empty($_POST['correo'])){
                $pass = substr((microtime()), 1, 10);
                $mail = $_POST['correo'];
                
                $server = "localhost";
                $userbd = "root";
                $passbd = "";
                $db = "rapienvio";
                //Conecto
                $conexion = mysqli_connect($server,$userbd,$passbd,$db);
                
                $sql = "UPDATE usuario SET contrasena='$pass' WHERE correo='$mail'";

                if ($conexion->query($sql) === TRUE) {
 
                } else {
                    echo "Error modificando: " . $conexion->error;
                }
                
                $to = $_POST['correo'];//"destinatario@email.com";
                $from = "From: " . "Rapienvios" ;
                $subject = "Recordar contraseña";
                $message = "El sistema le asigno la siguiente clave incluyendo el punto (.): " . $pass;

                mail($to, $subject, $message, $from);
                echo 'Contraseña modificada satisfactoriamente revisa tu correo: ' . $_POST['correo'];
            }

		}
		catch (Exception $e) {
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
            
        ?>

  <script type="text/javascript">

  </script>
</html>