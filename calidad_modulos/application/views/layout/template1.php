<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#6640b2">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Sistemas para la Gestión Malpo SPA">
  <meta name="keywords" content="malpo, innovamalpo, gerencia técnica, administración, inmobiliaria">
  <meta name="author" content="Malpo SPA">

  <title><?= $titulo ?></title>

  <link rel="apple-touch-icon" href="<?= base_url() ?>app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>app-assets/images/ico/favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/plugins/animate/animate.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/core/menu/menu-types/vertical-overlay-menu.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
  <!-- END Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/bootstrap-select.css">



</head>

<body class="vertical-layout vertical-overlay-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">

  <script src="<?= base_url() ?>app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/ui/popper.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>

  <script src="<?= base_url() ?>assets/js/funciones_all.js" type="text/javascript"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header bg-grad-streaks">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="<?= base_url() ?>">
              <img class="brand-logo" src="<?= base_url() ?>app-assets/images/logo/m.png" width="30">
              <h2 class="brand-text ">SISTEMA </h2>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
              <span class="avatar avatar-online">
                <span class="bg-grad-danger circle-usuario text-uppercase"><b><?= $_SESSION['usuario'][0] ?></b></span>
              </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content" id="nav-superior">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block">
              <!-- Ícono de menú en pantallas pequeñas -->
              <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a>
            </li>            
          </ul>
          <ul class="nav navbar-nav float-right">

            <li class="dropdown nav-item">

              <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                <i class="ft-home"></i>
                <span class=""><?= $_SESSION['nombreObra'] ?></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right menuObras">

                <a class="dropdown-item" href="<?= base_url() . $ctrl ?>/0" aria-expanded="false">
                  <span class="badge badge badge-primary badge-pill ft-home">
                  </span>
                  <span class="menu-title">OBRAS</span>
                </a>

                <?php if(empty($menu)){}else{ ?>
                <?php foreach ($menu as $key => $value) { ?>
                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="<?= base_url() . $ctrl . $value['ctrl'] ?>" aria-expanded="false">
                    <span class="badge badge badge-primary badge-pill">
                      <?= $value['contador'] ?>
                    </span>
                    <span class="menu-title"> <?= $value['nombre'] ?></span>
                  </a>

                <?php }} ?>
              </div>
            </li>



            <!-- MENÚ USUARIO-->
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="avatar avatar-online ">
                  <span class="bg-grad-danger circle-usuario">
                    <?= strtoupper($_SESSION['nombre'][0]); ?>
                  </span>
                </span>
                <span class="user-name"><?= $_SESSION['email']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <span class="with-arrow">
                  <span style="background: #ab26aa"></span>
                </span>
                <div class="dropdown-menu-header bg-grad-danger" style="padding: 4px">
                  <h4 class="dropdown-header m-0">
                    <span class="white"><?= $_SESSION['nombre']; ?></span>
                    <br>
                    <span class="white text-lowercase font-small-2"><?= $_SESSION['email']; ?></span>
                    <br>
                    <span class="white text-lowercase font-small-2"><?= $_SESSION['perfil']; ?></span>
                    <br>
                    <span class="white text-lowercase font-small-2"><?= $_SESSION['departamento']; ?></span>
                  </h4>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url() ?>ctrl_login/logout"><i class="ft-power"></i> Cerrar Sesión</a>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Menú Lateral-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">

    <!-- main menu content-->
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <?php
        foreach ($menu_modulos as $key => $value) {
          $act = '';
          if ($item_menu == $value['id']) {
            $act = 'active';
          }

          echo '<li class="nav-item ' . $act . '">
        <a href="' . $value['ctrl'] . '">
        <i class="' . $value['icono'] . '"></i>
        <span class="menu-title">' . $value['nombre'] . '</span>
        </a>';
          if (is_null($value['sub_menu'])) { } else {
            echo '<ul class="menu-content">';
            foreach ($value['sub_menu'] as $rows => $row) {
              $act2 = '';

              if ($item_menu == $row['id']) {
                $act2 = 'active';
              }
              echo '<li class="nav-item ' . $act2 . '">
          <a class="menu-item" href="' . $row['ctrl'] . '">
          <i class="' . $row['icono'] . '"></i> ' . $row['nombre_row'] . '
          </a></li>';
            }
            echo '</ul>';
          }
          echo '</li>';
        } ?>       

        <li class="nav-item">
          <a href="<?= base_url() ?>ctrl_login/logout">
            <i class="ft-log-in"></i>
            <span class="menu-title" data-i18n=""> Cerrar Sesión</span>
          </a>
        </li>


      </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <!-- main menu footer-->
  </div>
  <!-- / Menú Lateral-->

  <!-- Contenido Principal-->
  <div class="app-content content">
    <div class="content-wrapper">
      <button id="btn-scroll" class="bg-primary animated rotateIn" title="Subir">
        <i class="fa fa-angle-double-up"></i>
      </button>
      <?= $contenido ?>
    </div>
  </div>
  <!-- / Contenido Principal-->

  <footer class="footer footer-static footer-dark navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">

        <a class="text-bold-800 grey darken-2" href="www.malpo.cl" target="_blank"> Malpo </a> <?= YEAR ?>. Todos los derechos reservados.
      </span>

      <span class="float-md-right d-block d-md-inline-block d-none d-lg-block primary ">
        <i class="ft-hash danger"></i> Dev Team Malpo
      </span>
    </p>
  </footer>

  <!-- BEGIN VENDOR JS-->

  <script src="<?= base_url() ?>app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/ui/jquery-sliding-menu.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?= base_url() ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/js/core/app.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <!-- END PAGE LEVEL JS-->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

  <!-- CUSTOM JS -->
  <script src="<?= base_url() ?>assets/js/scripts.js" type="text/javascript"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

  <script src="<?= base_url() ?>app-assets/js/core/libraries/bootstrap-select.js" type="text/javascript"></script>

</body>

</html>

<style type="text/css">
  .dropdown-menu {
    max-height: auto;
    overflow: hidden;
    overflow-y: auto;
  }

  .menuObras
    {
       height: auto;
       overflow-y: auto;
    }
</style>