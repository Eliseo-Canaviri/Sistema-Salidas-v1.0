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

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include "Views/Templates/footer.php"; ?>