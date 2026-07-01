<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro | Modern UI</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/favicon.png" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/estilos.min.css" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/registro.css" rel="stylesheet" />

    <!-- Asegúrate de tener cargado FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />

</head>

<body>
    <div class="page-wrapper" id="main-wrapper">
        <div class="min-vh-100 d-flex align-items-center justify-content-center p-4">
            <div class="w-100" style="max-width: 750px;">
                <div class="card card-registro">
                    <div class="card-body p-4 p-md-4">

                        <!-- Logo -->
                        <div class="text-center mb-3">
                            <a href="./index.html" class="d-inline-block mb-3">
                                <img src="<?php echo base_url; ?>Assets/img/log.png" width="150" alt="Logo">
                            </a>
                            <h4 class="fw-bold text-dark mb-1">Crea tu cuenta</h4>
                            <p class="text-muted small">Ingresa tus datos para registrarte en la plataforma</p>
                        </div>
                        <!-- Formulario -->
                        <form method="post" id="frmUsuario" autocomplete="off">
                            <input type="hidden" id="id" name="id">

                            <div class="row g-3">
                                <!-- CI -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input id="ci" class="form-control" type="text" name="ci" placeholder="CI"
                                            required>
                                        <label for="ci"><i class="fas fa-id-card icon-addon"></i> CI <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <!-- Celular -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input id="celular" class="form-control " type="number" name="celular"
                                            placeholder="Celular">
                                        <label for="celular"><i class="fas fa-phone icon-addon"></i> Celular <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Nombres -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input id="nombres" class="form-control text-uppercase-input" type="text"
                                            name="nombres" placeholder="Nombres" required>
                                        <label for="nombres"><i class="fas fa-user icon-addon"></i> Nombres <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Apellidos -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input id="apellidos" class="form-control text-uppercase-input" type="text"
                                            name="apellidos" placeholder="Apellidos" required>
                                        <label for="apellidos"><i class="fas fa-user-tag icon-addon"></i> Apellidos
                                            <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input type="text" id="id_cargo" name="id_cargo">
                                    <div class="form-floating">
                                        <input class="form-control text-uppercase-input" id="select_cargo"
                                            name="select_cargo" type="text" placeholder="Buscar ...">
                                        <label>
                                            <i class="fas fa-briefcase me-1 text-primary"></i>Buscar Cargo <span
                                                class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="form-text text-muted ms-1" style="font-size: 0.85rem;">
                                        <i class="fas fa-info-circle me-1 text-secondary"></i>Si no existe su cargo,
                                        ingrese el cargo correspondiente.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" id="id_unidad" name="id_unidad">
                                    <div class="form-floating">
                                        <input class="form-control text-uppercase-input" id="select_unidad"
                                            name="select_unidad" type="text" placeholder="Buscar ...">
                                        <label>
                                            <i class="fas fa-building me-1 text-success"></i>Buscar Unidad <span
                                                class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="form-text text-muted ms-1" style="font-size: 0.85rem;">
                                        <i class="fas fa-info-circle me-1 text-secondary"></i>Si no existe su unidad,
                                        ingrese la unidad correspondiente.
                                    </div>
                                </div>


                            </div>

                            <!-- Botón de Registro dentro del formulario -->
                            <div class="mt-4 mb-3">
                                <button type="button" class="btn btn-primary btn-modern w-100 fs-4"
                                    onclick="registrarUserPrinciapal(event);" id="btnAccion">
                                    <i class="fas fa-user-plus me-2"></i> Registrar Usuario
                                </button>
                            </div>
                        </form>

                        <!-- Enlace de inicio de sesión -->
                        <div class="text-center mt-3">
                            <p class="mb-0 text-muted">¿Ya tienes una cuenta?
                                <a class="text-primary fw-bold ms-1 text-decoration-none"
                                    href="<?php echo base_url; ?>Usuarios">Iniciar Sesión</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Función reutilizable para limpiar el ID cuando el buscador se vacía
            function vincularLimpiezaInput(idBuscador, idOculto, nombreCampo) {
                const buscador = document.getElementById(idBuscador);
                const oculto = document.getElementById(idOculto);

                if (buscador && oculto) {
                    buscador.addEventListener('input', function () {
                        if (this.value.trim() === "") {
                            oculto.value = "";
                            console.log(`ID de ${nombreCampo} limpiado con éxito.`); // Control en consola
                        }
                    });
                }
            }

            // Aplicar la lógica a Cargo
            vincularLimpiezaInput('select_cargo', 'id_cargo', 'Cargo');

            // Aplicar la lógica a Unidad
            vincularLimpiezaInput('select_unidad', 'id_unidad', 'Unidad');

        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script src="ruta_de_tu_archivo_script.js"></script>
    <!-- Scripts -->

    <script src="<?php echo base_url; ?>Assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
    <script src="<?php echo base_url; ?>Assets/js/registro.js"></script>
</body>

</html>