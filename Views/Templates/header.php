<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Admin-Salidas </title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/logos/seodashlogo.png" />
  <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />


  <!-- Data table css-->
  <link href="<?php echo base_url; ?>Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
  <!-- Select2   css-->
  <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url; ?>Assets/css/ojo.css" rel="stylesheet" />

  <link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" href="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
</head>

<body >
    <?php
                    date_default_timezone_set('America/La_Paz');
                    ?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?php echo base_url; ?>Administracion/home" class="text-nowrap logo-img">
            <img src="<?php echo base_url; ?>Assets/IMG/logos/logos.png" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <!-- INICIO -->
            <li class="nav-small-cap">
              <i class="ti ti-home nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">INICIO</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo base_url; ?>Administracion/home">
                <span>
                  <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <!-- ADMINISTRACIÓN -->
            <li class="nav-small-cap">
              <i class="ti ti-settings nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">ADMINISTRACIÓN</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:users-group-rounded-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Gestión General</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo base_url; ?>Usuarios" class="sidebar-link">
                    <span class="hide-menu">Usuarios</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url; ?>Permisos" class="sidebar-link">
                    <span class="hide-menu">Permisos</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url; ?>Cargos" class="sidebar-link">
                    <span class="hide-menu">Cargos</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url; ?>Unidades" class="sidebar-link">
                    <span class="hide-menu">Unidades</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-small-cap text-uppercase text-muted opacity-75 fw-bold fs-2 tracking-wider mb-2">
              <i class="ti ti-car nav-small-cap-icon fs-6 me-2"></i>
              <span class="hide-menu">Salidas</span>
            </li>

            <li class="sidebar-item mb-1">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span class="sidebar-icon-wrapper">
                  <iconify-icon icon="solar:bus-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Registro de Salida</span>
              </a>

              <ul aria-expanded="false" class="collapse first-level ps-3">
                <li class="sidebar-item">
                  <a href="<?php echo base_url; ?>Salidas"
                    class="sidebar-link sub-link <?php echo (basename($_SERVER['REQUEST_URI']) == 'Salidas') ? 'active-blue' : ''; ?>">
                    <div class="bullet-dot me-2"></div>
                    <span class="hide-menu">Salidas</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- REPORTES -->
            <li class="nav-small-cap">
              <i class="ti ti-chart-bar nav-small-cap-icon fs-6"></i>
              <span class="hide-menu">REPORTES</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <iconify-icon icon="solar:transfer-horizontal-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Reportes</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">

                <li class="sidebar-item">
                  <a class="sidebar-link" href="<?php echo base_url; ?>Reportes">
                    <span>
                      <iconify-icon icon="solar:chart-square-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Reportes</span>
                  </a>
                </li>


              </ul>
            </li>

          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <a href="<?php echo base_url; ?>Usuarios/perfil" class="btn btn-success"><span
                  class="d-none d-md-block"><?php echo $_SESSION['nombres'] ?> </span>
                <span class="d-block d-md-none"><?php echo $_SESSION['nombres'] ?> </span></a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?php echo base_url; ?>Assets/img/dos.jpg" alt="" width="35" height="35"
                    class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">

                  <div class="message-body">
                    <a href="<?php echo base_url; ?>Usuarios/perfil"
                      class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Mi Perfil</p>
                    </a>
                    <a href="<?php echo base_url; ?>Usuarios/cuenta"
                      class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">Mi Cuenta</p>
                    </a>
                    <a href="<?php echo base_url; ?>Usuarios/tareas"
                      class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Mis Tareas</p>
                    </a>
                    <a href="<?php echo base_url; ?>Usuarios/salir"
                      class="btn btn-outline-primary mx-3 mt-2 d-block">Salir</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <?php
      date_default_timezone_set('America/La_Paz');
      ?>
      <!--  Header End -->
     
        <div class="container-fluid">
            <div class="row">
                <!-- Todo tu contenido aquí -->
      