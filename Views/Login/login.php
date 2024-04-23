<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Abel OSH">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.ico">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/styles.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login - Tienda | Online</title>
  <title><?= $data['page_tag']; ?></title>
</head>

<body>
<section class="material-half-bg">
      <div class="cover"></div>
    </section>
  <section class="login-content">
    <div class="logo">
      <h1><?= $data['page_title']; ?></h1>
    </div>
    <div class="login-box">
      <div id="divLoading">
        <div>
          <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
        </div>
      </div>
      <form class="login-form" name="formLogin" id="formLogin" >
        <h3 class="login-head"><i class="bi bi-person me-2 fs-1"></i>INICIAR SESIÓN</h3>
        <div class="mb-3">
          <label class="form-label">USUARIO</label>
          <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">CONTRASEÑA</label>
          <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
        </div>
        <div class="mb-3">
          <div class="utility">
            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
          </div>
        </div>
        <div id="alertLogin" class="text-center"></div>
        <div class="mb-3 btn-container d-grid">
          <button type="submit" class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i> INICIAR SESIÓN</button>
        </div>
      </form>
      <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
     
        <h4 class="login-head"> <i class="bi bi-person-lock me-2 fs-1"></i> ¿Olvidaste la contraseña?</h4>
        <div class="mb-3">
          <label class="form-label">EMAIL</label>
          <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
        </div>
        <div class="mb-3 btn-container d-grid"">
          <button type="submit" class="btn btn-primary btn-block form-control"><i class="bi bi-unlock me-2 fs-5"></i>REINICIAR</button>
        </div>
        <div class="mb-3 mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="bi bi-chevron-left me-1"></i> Iniciar sesión</a></p>
        </div>
      </form>
    </div>
  </section>
  <script>
    const base_url = "<?= base_url(); ?>";
  </script>
  <!-- Essential javascripts for application to work-->
  <script src="<?= media(); ?>/js/plugins/jquery-3.7.1.min.js"></script>
  <script src="<?= media(); ?>/js/plugins/select2.js"></script>
  <script src="<?= media(); ?>/js/plugins/bootstrap.bundle.min.js"></script>
  <script src="<?= media(); ?>/js/plugins/main.js"></script>
  <script src="<?= media(); ?>/js/plugins/fontawesome.js"></script>
  <script src="<?= media(); ?>/js/plugins/all.min.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
  <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
</body>

</html>