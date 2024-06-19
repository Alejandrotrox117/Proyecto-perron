<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
    <meta name="description" content="Celtech Store">
    <title><?= $data['page_tag'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/styles.css">
  <link href="<?= media(); ?>/fontawesome/css/solid.css" rel="stylesheet" />
  <link href="<?= media(); ?>/fontawesome/css/fontawesome.css" rel="stylesheet" />
  <link href="<?= media(); ?>/fontawesome/css/brands.css" rel="stylesheet" />
    <link rel="shortcut icon" href="<?= media(); ?>/img/favicon.ico">
    <!-- Font-icon css-->
   
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">Celtech Store</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars"></i></a>
      
       
        <!-- User Menu-->
        <!-- <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="fa fa-cog fa-lg"></i> Opciones</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url(); ?>/salir"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul> -->
    </header>
    <?php require_once("navbar_admin.php"); ?>