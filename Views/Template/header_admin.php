<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Tienda online VitalGrow Perú S.A.C">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Joel Cevallos">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= media(); ?>/images/icono.ico">


  <title><?= $data['tag_page'] ?></title>

  <!-- Main CSS-->

  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/select2.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/styles.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/sweetalert2.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="alternate" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" >

</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">VitalGrow Perú</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item text-dark" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="bi bi-gear me-2 fs-5"></i> Configuración</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="bi bi-person me-2 fs-5"></i> Perfil</a></li>
          <li><a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Salir</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <?php require_once("nav_admin.php"); ?>