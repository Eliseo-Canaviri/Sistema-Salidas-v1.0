<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-2">
  <div>
    <h2><i class="fa-solid fa-users-line "></i></i> Usuarios </h2>
  </div>
</div>

<div class="mx-2">
  <button class="btn btn-primary mb-3" type="button" onclick="frmUsuario();">Nuevo <i
      class="fa-solid fa-user-plus"></i></button>

  <a class="btn btn-warning mb-3 mx-1  " href="<?php echo base_url; ?>Usuarios/inactivos"> Inactivos <i
      class="fa-solid fa-user-slash"></i></a>
</div>


<!-- table table-dark // para volver la tabla oscuro-->

<!--  Header End -->
<div class="container-fluid">
  <div class="card-body">
    <div class="card">
      <div class="card-body p-4">
        <table class="table  table-hover" id="tblUsuarios">
          <thead class="table-dark ">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">CI</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Celular</th>
              <th scope="col">id_cargo</th>
              <th scope="col">id_unidad</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="nuevo_usuario" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow">

      <!-- Header -->
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title">
          Registro de Funcionario
        </h5>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">

        <form method="POST" id="frmUsuario">

          <input type="hidden" id="id" name="id">

          <div class="row">

            <!-- CI -->
            <div class="col-md-4 mb-3">
              <label for="ci" class="form-label fw-bold">C.I</label>

              <input type="text" class="form-control" id="ci" name="ci" placeholder="Ej: 1234567" required>

              <small class="text-muted">
                Ejemplo con complemento: 123424234-1H
              </small>
            </div>
            <!-- Nombres -->
            <div class="col-md-4 mb-3">
              <label for="nombres" class="form-label fw-bold">
                Nombres
              </label>

              <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ej: Juan" required>
            </div>

            <!-- Apellidos -->
            <div class="col-md-4 mb-3">
              <label for="apellidos" class="form-label fw-bold">
                Apellidos
              </label>

              <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ej: Pérez Mamani"
                required>
            </div>
            <!-- Celular -->
            <div class="col-md-4 mb-3">
              <label for="celular" class="form-label fw-bold">
                Celular
              </label>

              <input type="number" class="form-control" id="celular" name="celular" placeholder="Ej: 71234567" required>
            </div>

            <!-- Cargo -->

            <div class="col-md-4">
              <div class="form-group">
                <label for="id_cargo" class="form-label fw-bold">
                  <i class="fa-brands fa-usps"></i> Cargo
                </label>
                <select id="id_cargo" name="id_cargo" class="form-select" required>
                  <option value="" selected disabled>
                    Seleccione una Cargo
                  </option>
                  <?php foreach ($data['cargos'] as $row) { ?>
                    <option value="<?php echo $row['id_cargo']; ?>">
                      <?php echo $row['nombre']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>


            <!-- Unidad -->
            <div class="col-md-4">
              <div class="form-group">
                <label for="id_unidad" class="form-label fw-bold">
                  <i class="fas fa-building"></i> Unidad
                </label>
                <select id="id_unidad" name="id_unidad" class="form-select" required>
                  <option value="" selected disabled>
                    Seleccione una Unidad
                  </option>
                  <?php foreach ($data['unidades'] as $row) { ?>
                    <option value="<?php echo $row['id_unidad']; ?>">
                      <?php echo $row['nombre']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

        </form>

      </div>

      <!-- Footer -->
      <div class="modal-footer">

        <button type="button" class="btn btn-primary" onclick="registrarUser(event);" id="btnAccion">

          <i class="fas fa-save"></i> Registrar
        </button>

        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">

          <i class="fas fa-times"></i> Cerrar
        </button>

      </div>

    </div>
  </div>
</div>
<!-- Fin Modal -->







<?php include "Views/Templates/footer.php"; ?>