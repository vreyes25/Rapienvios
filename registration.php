<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="shortcut icon" href="img/RLogo.png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
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
      <form action="" method="post">
          <h2>REGISTRATE</h2>
          <i class="ri-emotion-line icons name"></i>
          <input type="text" name="username" placeholder="Ingrese su nombre">
          <i class="ri-mail-line icons mail"></i>
          <input type="email" name="password" placeholder="Ingrese su correo">
          <i class="ri-user-line icons user"></i>
          <input type="text" name="username" placeholder="Ingrese su usuario">
          <i class="ri-lock-2-line icons password"></i>
          <input type="password" name="password" placeholder="Ingrese su contraseña">
          <button class="startSession">Registrarse</button>
          <p>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
      </form>
      <img id="cover" src="img/Personaje.png" alt="cover">
    </section>
  </body>
</html>