<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Registrar
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
   <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />

</head>

<body class="">

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url(<?php echo base_url; ?> Assets/img/registrar.jpg); background-size: cover;">

              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Registrarse</h4>
                  <p class="mb-0">Ingresa Sus Datos para Registrarte</p>
                </div>
                <div class="card-body">
                  <form id="RegistrarVista" onsubmit="RegistrarVista(event);">
                    <div class="input-group input-group-outline mb-3">
                      <label for="nombre"></label>
                      <input type="hidden" id="id" name="id" class="form-control">
                      <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese su Nombres">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label for="email"></label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Correo">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label for="usuario"></label>
                      <input type="usuario" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="input-group input-group-outline mb-3">
                          <div class="input-group input-group-outline mb-3">
                            <label for="clave"></label>
                            <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña">
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-outline mb-3">
                          <div class="input-group input-group-outline mb-3">
                            <label for="confirmar"></label>
                            <input type="password" id="confirmar" name="confirmar" class="form-control" placeholder="Confirmar">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrarse</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">

                    ¿Ya tienes una cuenta?
                    <a href="<?php echo base_url; ?>Home" class="text-primary text-gradient font-weight-bold">Iniciar Sesión</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->

  <script src="<?php echo base_url; ?>Assets/js/jquery_3.7.0.min.js"></script>


  <script>
    const base_url = "<?php echo base_url; ?>";
  </script>
  <script src=" <?php echo base_url; ?>Assets/js/sweetalert2.all.min.js "></script>
  <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
  <script src="<?php echo base_url; ?>Assets/js/registrarvista.js"></script>


</body>

</html>