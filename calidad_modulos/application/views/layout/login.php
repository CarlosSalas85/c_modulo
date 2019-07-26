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
    <title>Inicio Malpo</title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/plugins/animate/animate.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/app.css">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>app-assets/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    <!-- END Custom CSS-->
    
    <style type="text/css">
      body,html {
        height: 80%;
      }
      .card-subtitle{
        margin: 0 !important;
      }
    </style>

  </head>
  <body class="vertical-layout vertical-menu 1-column bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
 
      
    <div class="content-body">
      <section class="flexbox-container"><!---->
        <div class="col-12 d-flex align-items-center justify-content-center mt-3 mb-2"><!--  -->
          <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0"><!-- m-0 -->
              <div class="card-header border-0">
                <div class="card-title text-center">
                  <div class="p-0 animated pulse">
                    <img src="<?= base_url() ?>app-assets/images/logo/logo.png" width="80%" alt="Malpo" >
                  </div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                  <span>Ingreso Plataformas Malpo</span>
                </h6>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form class="form-horizontal form-simple" action="<?= base_url() ?>Ctrl_login/nuevo_ingreso" novalidate>
                    <fieldset class="form-group position-relative has-icon-left mb-1">
                      <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Usuario"
                      required>
                      <div class="form-control-position animated tada">
                        <i class="ft-user "></i>
                      </div>
                    </fieldset>

                    <fieldset class="form-group position-relative has-icon-left">
                      <input type="password" class="form-control form-control-lg" id="clave" placeholder="Contraseña"
                      required>
                      <div class="form-control-position animated tada">
                        <i class="fa fa-key"></i>
                      </div>
                    </fieldset>
                    <div class="form-group row">
                      <div class="col-md-6 col-12 text-center text-md-left">
                        <fieldset>
                          <input type="checkbox" id="remember-me" class="chk-remember">
                          <label for="remember-me"> Recordar</label>
                        </fieldset>
                      </div>
                      <div class="col-md-6 col-12 text-center text-md-right"><a href="recover-password.html" class="card-link">¿Olvidó la contraseña?</a></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block animated fadeInDown" id="btn_login"><i class="ft-unlock" ></i> Ingresar</button>
                  </form>
                </div>
              </div>
              <div class="card-footer">
                <div class="">
                  <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recuperar contraseña</a></p>
                  <p class="float-sm-right text-center m-0">¿Nuevo usuario? <a href="register-simple.html" class="card-link">Registrar</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
     </section>
    </div>

  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="<?= base_url() ?>app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="<?= base_url() ?>app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>app-assets/js/core/app.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?= base_url() ?>app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->

  

</body>
</html>