<?php include "Views/Templates/header.php"; ?>

<div class="app-title mx-2">
  <div>
    <h2><i class="fa-solid fa-ban"></i> Salidas Inactivas</h2>
  </div>
</div>

<div class="mx-2">
  <a class="btn btn-primary mb-3" href="<?php echo base_url; ?>Salidas">
    <i class="fa-solid fa-arrow-left"></i> Volver a Activos
  </a>
</div>

<div class="container-fluid">
  <div class="card-body">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <table class="table table-hover" id="tblSalidasInactivas">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Funcionario</th>
              <th>Actividad</th>
              <th>Lugar</th>
              <th>Transporte</th>
              <th>Fecha Salida</th>
              <th>Hora Salida</th>
              <th>Hora Llegada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data['salidas'])): ?>
              <?php foreach ($data['salidas'] as $s): ?>
                <tr>
                  <td><?php echo $s['id_salida']; ?></td>
                  <td><?php echo htmlspecialchars($s['funcionario']); ?></td>
                  <td><?php echo htmlspecialchars($s['actividad']); ?></td>
                  <td><?php echo htmlspecialchars($s['lugar']); ?></td>
                  <td><?php echo $s['transporte'] ? htmlspecialchars($s['transporte']) : '<span class="text-muted">—</span>'; ?></td>
                  <td><?php echo $s['fecha_salida']; ?></td>
                  <td><?php echo $s['hora_salida']; ?></td>
                  <td><?php echo $s['hora_llegada']; ?></td>
                  <td>
                    <button class="btn btn-sm btn-success" type="button"
                      onclick="btnReactivarSalida(<?php echo $s['id_salida']; ?>);" title="Reactivar">
                      <i class="fa-solid fa-rotate-left"></i> Reactivar
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center text-muted">No hay salidas inactivas.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include "Views/Templates/footer.php"; ?>
