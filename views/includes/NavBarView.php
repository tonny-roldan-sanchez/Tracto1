<?php
function NavBarView()
{
  $usuario = $_SESSION['usuario'] ?? [];
  $nombreUsuario = e((string) ($usuario['nombre'] ?? 'Usuario'));
  $fotoUsuario = e((string) ($usuario['foto'] ?? 'public/assets/images/faces/face28.png'));

  return "
    <nav class='navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row'>
        <div class='text-center navbar-brand-wrapper d-flex align-items-center justify-content-center'>
          <a class='navbar-brand brand-logo' href='index.html'><img src='public/assets/images/logotractopension.png' alt='logo' /></a>
          <a class='navbar-brand brand-logo-mini' href='index.html'><img src='public/assets/images/logo-mini.svg' alt='logo' /></a>
        </div>
        <div class='navbar-menu-wrapper d-flex align-items-stretch'>
          <button class='navbar-toggler navbar-toggler align-self-center' type='button' data-toggle='minimize'>
            <span class='mdi mdi-menu'></span>
          </button>
          
          <ul class='navbar-nav navbar-nav-right'>
            <li class='nav-item  dropdown d-none d-md-block'>
              <a class='nav-link dropdown-toggle' id='reportDropdown' href='#' data-toggle='dropdown' aria-expanded='false'> Reportes </a>
              <div class='dropdown-menu navbar-dropdown' aria-labelledby='reportDropdown'>
                <a class='dropdown-item' href='#'>
                  <i class='mdi mdi-file-pdf mr-2'></i>PDF </a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' href='#'>
                  <i class='mdi mdi-file-excel mr-2'></i>Excel </a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' href='#'>
                  <i class='mdi mdi-file-word mr-2'></i>doc </a>
              </div>
            </li>
            
            
            <li class='nav-item nav-profile dropdown'>
              <a class='nav-link dropdown-toggle' id='profileDropdown' href='#' data-toggle='dropdown' aria-expanded='false'>
                <div class='nav-profile-img'>
                  <img src='$fotoUsuario' alt='Foto de perfil'>
                </div>
                <div class='nav-profile-text'>
                  <p class='mb-1 text-black'>$nombreUsuario</p>
                </div>
              </a>
              <div class='dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm' aria-labelledby='profileDropdown' data-x-placement='bottom-end'>
                <div class='p-3 text-center bg-primary'>
                  <img class='img-avatar img-avatar48 img-avatar-thumb' src='$fotoUsuario' alt='Foto de perfil'>
                </div>
                <div class='p-2'>
                  <h5 class='dropdown-header text-uppercase pl-2 text-dark'>Opciones de Usuario</h5>
                  
                    <a class='dropdown-item py-1 d-flex align-items-center justify-content-between' href='?menu=perfil'>                    
                    <span>Perfil</span>
                    <span class='p-0'>
                      <span class='badge badge-success'>1</span>
                      <i class='mdi mdi-account-outline ml-1'></i>
                    </span>
                  </a>
                  
                  <a class='dropdown-item py-1 d-flex align-items-center justify-content-between' href='?menu=respaldo'>
                  <span>Respaldo</span>
                 <i class='mdi mdi-database-export ml-1'></i>
                  </a>

                  <div role='separator' class='dropdown-divider'></div>
                  <h5 class='dropdown-header text-uppercase  pl-2 text-dark mt-2'>Accciones</h5>

                  <a class='dropdown-item py-1 d-flex align-items-center justify-content-between' href='?menu=password'>

    <span>Cambiar Contraseña</span>

    <i class='mdi mdi-lock-reset ml-1'></i>

</a>
                  
                  <a class='dropdown-item py-1 d-flex align-items-center justify-content-between' href='?menu=logout'>
                    <span>Cerrrar Sesión</span>
                    <i class='mdi mdi-logout ml-1'></i>
                  </a>
                </div>
              </div>
            </li>
            
            
          </ul>
          <button class='navbar-toggler navbar-toggler-right d-lg-none align-self-center' type='button' data-toggle='offcanvas'>
            <span class='mdi mdi-menu'></span>
          </button>
        </div>
      </nav>
    ";
}
