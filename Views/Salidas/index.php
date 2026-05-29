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
  <a class="btn btn-warning mb-3 mx-1" href="<?php echo base_url; ?>Salidas/inactivos">
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

            <!-- Funcionario -->
            <div class="col-md-12 mb-3">
              <label for="id_funcionario" class="form-label fw-bold">
                <i class="fa-solid fa-user-tie me-1"></i> Funcionario <span class="text-danger">*</span>
              </label>
              <select class="form-select" id="id_funcionario" name="id_funcionario" required>
                <option value="">-- Seleccionar Funcionario --</option>
                <?php foreach ($data['funcionarios'] as $func): ?>
                  <option value="<?php echo $func['id']; ?>">
                    <?php echo $func['nombre_completo'] . ' (CI: ' . $func['ci'] . ')'; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Actividad -->
            <div class="col-md-12 mb-3">
              <label for="actividad" class="form-label fw-bold">
                <i class="fa-solid fa-briefcase me-1"></i> Actividad / Motivo <span class="text-danger">*</span>
              </label>
              <textarea class="form-control" id="actividad" name="actividad" rows="2"
                placeholder="Ej: Reunión de coordinación técnica..." required></textarea>
            </div>

            <!-- Lugar -->
            <div class="col-md-6 mb-3">
              <label for="lugar" class="form-label fw-bold">
                <i class="fa-solid fa-location-dot me-1"></i> Lugar de Destino <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" id="lugar" name="lugar"
                placeholder="Ej: Ministerio de Educación" required>
            </div>

            <!-- Transporte -->
            <div class="col-md-6 mb-3">
              <label for="transporte" class="form-label fw-bold">
                <i class="fa-solid fa-car me-1"></i> Medio de Transporte
              </label>
              <select class="form-select" id="transporte" name="transporte">
                <option value="">-- Seleccionar --</option>
                <option value="Vehículo Institucional">Vehículo Institucional</option>
                <option value="Transporte Público">Transporte Público</option>
                <option value="Vehículo Propio">Vehículo Propio</option>
                <option value="A pie">A pie</option>
                <option value="Otro">Otro</option>
              </select>
            </div>

            <!-- Fecha de Salida -->
            <div class="col-md-4 mb-3">
              <label for="fecha_salida" class="form-label fw-bold">
                <i class="fa-solid fa-calendar-days me-1"></i> Fecha de Salida <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
            </div>

            <!-- Hora de Salida -->
            <div class="col-md-4 mb-3">
              <label for="hora_salida" class="form-label fw-bold">
                <i class="fa-solid fa-clock me-1"></i> Hora de Salida <span class="text-danger">*</span>
              </label>
              <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
            </div>

            <!-- Hora de Llegada -->
            <div class="col-md-4 mb-3">
              <label for="hora_llegada" class="form-label fw-bold">
                <i class="fa-solid fa-clock me-1"></i> Hora de Llegada <span class="text-danger">*</span>
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
