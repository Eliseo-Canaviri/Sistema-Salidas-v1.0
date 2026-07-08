<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión | Modern UI</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/logos/seodashlogo.png" />
  <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />
  <!-- Asegúrate de tener cargado FontAwesome para los iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Estilos modernos y limpios */
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .card-login {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
      color: #5d87ff;
      transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-control {
      border: 1px solid #dfe5ef;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: all 0.2s ease-in-out;
    }

    .form-control:focus {
      border-color: #5d87ff;
      box-shadow: 0 0 0 0.25rem rgba(93, 135, 255, 0.15);
    }

    .btn-modern {
      background: #5d87ff;
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-modern:hover {
      background: #4570e6;
      transform: translateY(-1px);
      box-shadow: 0 5px 15px rgba(93, 135, 255, 0.3);
    }

    .icon-addon {
      vertical-align: middle;
      margin-right: 5px;
      font-size: 1.1rem;
      color: #7c8fac;
    }
    .text-uppercase-input {
    text-transform: uppercase;
}
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center p-4">
      <div class="w-100" style="max-width: 450px;">
        <div class="card card-login">
          <div class="card-body p-4 p-md-5">

            <!-- Logo y Encabezado -->
            <div class="text-center mb-4">
              <a href="#" class="d-inline-block mb-3">
                <img src="<?php echo base_url; ?>Assets/img/dos.jpg" alt="Logo" width="150">
              </a>
              <h4 class="fw-bold text-dark mb-1">¡Bienvenido de nuevo!</h4>
              <p class="text-muted small">Ingresa tus credenciales para acceder</p>
            </div>

            <!-- Formulario -->
            <form role="form" class="text-start" id="frmLogin" autocomplete="off">

              <!-- Alerta de Error (Manteniendo tu estructura) -->
              <div class="alert alert-danger text-center d-none mb-3" id="alerta" role="alert"></div>

              <!-- Input Usuario -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                <label for="usuario">
                  <iconify-icon icon="solar:user-bold" class="icon-addon"></iconify-icon> Usuario
                </label>
              </div>

              <!-- Contraseña -->
              <div class="form-floating mb-4 position-relative">
                <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required>

                <label for="clave">
                  <iconify-icon icon="solar:lock-password-bold"></iconify-icon>
                  Contraseña
                </label>

                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;"
                  onclick="togglePassword('clave', this)">
                  <i class="fa-solid fa-eye"></i>
                </span>
              </div>



              <!-- Botón Submit -->
              <div class="mb-4">
                <button type="submit" class="btn btn-primary btn-modern w-100 fs-4" onclick="frmLogin(event);">
                  Iniciar Sesión
                </button>
              </div>

              <!-- Sección de Registro Unificada -->
              <div class="text-center mt-3">
                <p class="mb-0 text-muted small">¿Eres nuevo en el sistema?</p>
                <a class="text-primary fw-bold text-decoration-none" href="<?php echo base_url; ?>Usuarios/registrarse">
                  Crea una cuenta aquí
                </a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Obligatorios -->
  <script src="<?php echo base_url; ?>Assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

  <script>
    const base_url = "<?php echo base_url; ?>";
  </script>
  <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
</body>

</html>