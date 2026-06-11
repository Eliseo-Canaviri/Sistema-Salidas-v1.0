<?php include "Views/Templates/header.php"; ?>

<div class="app-title mx-2">
  <div>
    <h2><i class="fa-solid fa-person-walking-arrow-right"></i> Salidas de Funcionarios</h2>
  </div>
</div>

<div class="mx-2">
  <button class="btn btn-primary mb-3" type="button" onclick="frmSalida();">
    Nueva Salida <i class="fa-solid fa-plus"></i>
  </button>
  <a class="btn btn-warning mb-3 mx-1" href="<?php echo base_url; ?>Salidas/inactivoVista">
    Inactivos <i class="fa-solid fa-ban"></i>
  </a>
</div>

<div class="container-fluid">
  <div class="card-body">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <table class="table table-hover" id="tblSalidas">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Funcionario</th>
              <th scope="col">Actividad</th>
              <th scope="col">Lugar</th>
              <th scope="col">Transporte</th>
              <th scope="col">Fecha Salida</th>
              <th scope="col">Hora Salida</th>
              <th scope="col">Hora Llegada</th>
              <th scope="col">Hora Llegada</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Registrar / Editar Salida -->
<div class="modal fade" id="modal_salida" data-bs-backdrop="static" data-bs-keyboard="false"
  aria-labelledby="modalSalidaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow">

      <!-- Header -->
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="title_salida">
          <i class="fa-solid fa-person-walking-arrow-right me-2"></i> Nueva Salida
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form method="POST" id="frmSalida">

          <input type="hidden" id="id_salida" name="id_salida">

          <div class="row">
            <!-- Hora de Llegada -->
            <div class="col-md-3 mb-3">
              <label for="nombres" class="form-label fw-bold">
                <i class="fa-solid fa-clock me-1"></i> Nombres <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="nombres" name="nombres"
                value="<?php echo $_SESSION['nombres'], ' ', $_SESSION['apellidos'] ?>" disabled required>
            </div>

            <!-- Lugar -->
            <div class="col-md-4 mb-3">
              <label for="lugar" class="form-label fw-bold">
                <i class="fa-solid fa-location-dot me-1"></i> Lugar de Destino <span class="text-danger">*</span>
              </label>
              <textarea type="text" class="form-control" id="lugar" name="lugar"
                placeholder="Ej: Distrito Jilawi Comunidad Koya Alta" required></textarea>
            </div>
            <!-- Actividad -->
            <div class="col-md-5 mb-3">
              <label for="actividad" class="form-label fw-bold">
                <i class="fa-solid fa-briefcase me-1"></i> Actividad / Motivo <span class="text-danger">*</span>
              </label>
              <textarea class="form-control" id="actividad" name="actividad" rows="2"
                placeholder="Ej: Realizar la inspección técnica del proyecto." required></textarea>
            </div>
            <!-- Cargo -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="id_chofer" class="form-label fw-bold">
                  <i class="fa-brands fa-usps"></i> Chofer
                </label>
                <select id="id_chofer" name="id_chofer" class="form-select" required>
                  <option value="" selected disabled>
                    Seleccione un Chofer
                  </option>
                  <?php foreach ($data['usuarios'] as $row) { ?>
                    <option value="<?php echo $row['id']; ?>">
                      <?php echo $row['nombres'] . ' ' . $row['apellidos']; ?>

                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="transporte" class="form-label fw-bold">
                <i class="fa-solid fa-car me-1"></i> MEDIO DE TRANSPORTE
              </label>
              <select class="form-select" id="transporte" name="transporte">
                <option value="VEHÍCULO DE LA ALCALDÍA">🚐 VEHÍCULO DE LA ALCALDÍA</option>
                <option value="TRANSPORTE PÚBLICO">🚌 TRANSPORTE PÚBLICO</option>
                <option value="VEHÍCULO PROPIO">🚙 VEHÍCULO PROPIO</option>
                <option value="A PIE">🚶 A PIE</option>
                <option value="OTRO">📌 OTRO</option>
              </select>
            </div>

            <!-- Fecha de Salida -->
            <div class="col-md-3 mb-3">
              <label for="fecha_salida" class="form-label fw-bold">
                <i class="fa-solid fa-calendar-days me-1"></i> Fecha de Salida <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control" id="fecha_salida" name="fecha_salida"
                value="<?= date('Y-m-d'); ?>" required>
            </div>

            <!-- Hora de Salida -->
            <div class="col-md-3 mb-3">
              <label for="hora_salida" class="form-label fw-bold">
                <i class="fa-solid fa-clock me-1"></i> Hora de Salida <span class="text-danger">*</span>
              </label>
              <input type="time" class="form-control" id="hora_salida" name="hora_salida" value="<?= date('H:i'); ?>"
                required>
            </div>
            <!-- Fecha de Llegada -->
            <div class="col-md-3 mb-3">
              <label for="fecha_llegada" class="form-label fw-bold">
                <i class="fa-solid fa-calendar-days me-1"></i> Fecha de Llegada <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada"
                value="<?= date('Y-m-d'); ?>" required>
            </div>

            <!-- Hora de Llegada -->
            <div class="col-md-3 mb-3">
              <label for="hora_llegada" class="form-label fw-bold">
                <i class="fa-solid fa-clock me-1"></i> Hora de Llegada
              </label>
              <input type="time" class="form-control" id="hora_llegada" name="hora_llegada" required>
            </div>

          </div>

        </form>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="registrarSalida(event);" id="btnAccionSalida">
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