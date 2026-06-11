<?php include "Views/Templates/header.php"; ?>
<div class="row">
    <!--Profile Card 3-->
    <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="card profile-card-3">



            <div class="card-content">
                <hr>
                <div class="text-center">

                    <img src="<?php echo base_url; ?>Assets/img/dos.jpg" width="200" height="200" class="rounded-circle"
                        alt="">
                </div>
                <div class="m-lg-3">
                    <h2 class="form-label">
                        <?php echo $data['usuarios']['nombres']; ?><small>

                        </small>
                    </h2>
                    <strong><i class="ti ti-list "></i> Apellidos: </strong>
                    <?php echo $data['usuarios']['apellidos']; ?><br>
                    <strong><i class="ti ti-phone"></i> Celular: </strong>
                    <?php echo $data['usuarios']['celular']; ?><br>

                    <strong><i class="ti ti-calendar"></i> Fecha registro: </strong>
                    <?php echo $data['usuarios']['fecha_creacion']; ?>

                    <div class="icon-block"><a href="#">
                            <i class="ti ti-facebook-square fa-2x text-primary"></i></a><a href="#">
                            <i class="ti ti-twitter-square fa-2x text-primary"></i></a><a href="#">
                            <i class="ti ti-google-plus fa-2x text-danger"></i></a>
                    </div>
                </div>


            </div>
            <br>
            <div class="text-center mb-3 d-grid gap-2 col-6 mx-auto  ">
                <button class="btn btn-outline-primary  " type="button" onclick="editarPerfil()">Editar</button>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12">
        <div class="card">
            <div class="card-header border-primary text-primary form-label">
                Datos Personales
            </div>
            <div class="card-body  form-label">
                <form class="my-1" id="frmDatos" onsubmit="actualizarDatosUsuario(event)" autocomplete="off">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input id="ci" class="form-control" type="text" name="ci" placeholder="Nombre"
                                    value="<?php echo $data['usuarios']['ci'] ?>" required>
                                <label for="ci"><i class="fas fa-list"></i> C.I.</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombre"
                                    value="<?php echo $data['usuarios']['nombres'] ?>" required>
                                <label for="nombres"><i class="fas fa-list"></i> Nombres</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input id="apellidos" class="form-control" type="text" name="apellidos"
                                    placeholder="Apellido" value="<?php echo $data['usuarios']['apellidos'] ?>"
                                    required>
                                <label for="apellidos"><i class="fas fa-list"></i> Apellidos</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-2">
                                <input id="celular" class="form-control" type="celular" name="celular"
                                    placeholder="Correo Electrónico" value="<?php echo $data['usuarios']['celular'] ?>"
                                    required>
                                <label for="celular"> <i class="fa-solid fa-mobile"></i> Celular</label>
                            </div>
                        </div>

                <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input id="cargo" class="form-control text-uppercase-input bg-light" type="text" name="cargo"
                                    placeholder="Cargo" value="<?php echo $data['usuarios']['nombre_cargo'] ?>" readonly required>
                                <label for="cargo">
                                    <i class="fas fa-briefcase me-1 text-primary"></i>
                                    Cargo <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input id="unidad" class="form-control text-uppercase-input bg-light" type="text" name="unidad"
                                    placeholder="Unidad" value="<?php echo $data['usuarios']['nombre_unidad'] ?>" readonly required>
                                <label for="unidad">
                                    <i class="fas fa-building me-1 text-success"></i>
                                    Unidad / Dependencia <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>


                        <div class="col-md-6 text-center ">
                            <div class="form-group ">
                                <div class=" col-md-12 d-grid gap-2 mt-3 text-center">
                                    <button class="btn btn-outline-primary d-none" type="submit"
                                        id="editarPerfil">Modificar</button>
                                </div>

                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-primary text-primary form-label">
                Midificar Contraseña
            </div>
            <div class="card-body form-label ">
                <form id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                    <div class="row">
                        <!-- Contraseña Actual -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3 position-relative">
                                <input id="clave_actual" class="form-control" type="password" name="clave_actual"
                                    placeholder="Contraseña Actual" required>
                                <label for="clave_actual"><i class="fas fa-key"></i> Contraseña Actual</label>
                                <span class="toggle-password" onclick="togglePassword('clave_actual')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Contraseña Nueva -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3 position-relative">
                                <input id="clave_nueva" class="form-control" type="password" name="clave_nueva"
                                    placeholder="Contraseña Nueva" required>
                                <label for="clave_nueva"><i class="fas fa-lock"></i> Contraseña Nueva</label>
                                <span class="toggle-password" onclick="togglePassword('clave_nueva')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="col-md-6">
                            <div class="form-floating mb-3 position-relative">
                                <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave"
                                    placeholder="Confirmar Contraseña" required>
                                <label for="confirmar_clave"><i class="fas fa-unlock"></i> Confirmar Contraseña</label>
                                <span class="toggle-password" onclick="togglePassword('confirmar_clave')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="col-md-6 text-center">
                            <div class="d-grid gap-2 mt-3 ml-2">
                                <button class="btn btn-outline-primary" type="submit">Modificar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>