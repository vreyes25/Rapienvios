<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Nuemorphism-card-design</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- partial -->
  
</body>
</html>

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
    <link rel="stylesheet" href="css/reportes.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.min.js"></script>
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <div class="decoration-line"></div>
      <ul class="dashboard-elements">
        <a href="dashboard.php">
          <li>
            <i class="ri-folder-user-fill side-icons"></i>
            Clientes
          </li>
        </a>

        <a href="paquetes.php">
          <li>
            <i class="ri-dropbox-fill side-icons"></i>
            Paquetes
          </li>
        </a>

        <a href="precios.php">
          <li>
            <i class="ri-price-tag-3-fill side-icons"></i>
            Precios
          </li>
        </a>

        <a href="empleados.php">
          <li>
            <i class="ri-user-fill side-icons"></i>
            Empleados
          </li>
        </a>

        <a href="envios.php">
          <li>
            <i class="ri-plane-fill side-icons"></i>
            Envios
          </li>
        </a>

        <a href="reportes.php">
          <li class="active">
            <i class="ri-article-fill side-icons"></i>
            Reportes
          </li>
        </a>

        <a href="cerrarSesion.php">
          <li class="logout">
            <i class="ri-logout-box-r-line side-icons"></i>
            Cerrar Sesión
          </li>
        </a>

      </ul>
    </div>

    <div class="container">
      <div class="card">
        <div class="box">
          <div class="content">
            <h2>01</h2>
            <h3>CLIENTES</h3>
            <a href="#">Generar Reporte</a>
          </div>
        </div>
      </div>
    
      <div class="card">
        <div class="box">
          <div class="content">
            <h2>02</h2>
            <h3>PAQUETES</h3>
            <a href="#">Generar Reporte</a>
          </div>
        </div>
      </div>
    
      <div class="card">
        <div class="box">
          <div class="content">
            <h2>03</h2>
            <h3>PRECIOS</h3>
            <a href="#">Generar Reporte</a>
          </div>
        </div>
      </div>
    
      <div class="card">
        <div class="box">
          <div class="content">
            <h2>04</h2>
            <h3>EMPLEADOS</h3>
            <a href="#">Generar Reporte</a>
          </div>
        </div>
      </div>
    
      <div class="card">
        <div class="box">
          <div class="content">
            <h2>05</h2>
            <h3>ENVIOS</h3>
            <a href="#">Generar Reporte</a>
          </div>
        </div>
      </div>
    
    </div>

    <script src="js/main.js"></script>
  </body>
</html>