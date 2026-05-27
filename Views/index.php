<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/logos/seodashlogo.png" />
  <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo base_url; ?>Assets/img/logos/logo-light.svg" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form role="form" class="text-start" id="frmLogin">

                  <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave">
                  </div>
                  <div class="text-center">
                    <div class="alert alert-danger text-center d-none " id="alerta" role="alert"></div>
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4"
                      onclick="frmLogin(event);">Iniciar Sesión</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    ¿No tienes una cuenta?
                    <a href="<?php echo base_url; ?>Home/registrar"
                      class="text-primary text-gradient font-weight-bold">Registrarse</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url; ?>Assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <script>
    const base_url = "<?php echo base_url; ?>";
  </script>
  <script src="<?php echo base_url; ?>Assets/js/login.js"></script>


</body>

</html>