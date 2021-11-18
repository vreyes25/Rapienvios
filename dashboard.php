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
    <title>Rapienvios | Dashboard</title>
  </head>
  <body>
    <div class="side-panel">
      <img src="img/Logo.png" alt="logo" id="logo" />
      <div class="decoration-line"></div>
      <ul class="dashboard-elements">
        <li class="active">
          <i class="ri-folder-user-fill side-icons "></i>
          <a href="#">Clientes</a>
        </li>
        <li>
          <i class="ri-dropbox-fill side-icons"></i>
          <a href="#">Paquetes</a>
        </li>
        <li>
          <i class="ri-price-tag-3-fill side-icons"></i>
          <a href="#">Precios</a>
        </li>
        <li>
          <i class="ri-user-fill side-icons"></i>
          <a href="#">Empleados</a>
        </li>
        <li class="logout">
          <i class="ri-logout-box-r-line side-icons"></i>
          <a href="#">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
    <div class="content-data">
        <div class="up-content">
            <div class="searchBar">
                <input type="text" id="search" placeholder="Buscar">
                <i class="ri-search-line searchButton"></i>
            </div>
            <div class="user-name">
                <h3>Bienvenido, <strong>Victor Reyes</strong></h3>
            </div>
        </div>
        <div class="data">
            <h3>Tablas dinámicas aparecerán aquí</h3>
        </div>
    </div>
  </body>
</html>