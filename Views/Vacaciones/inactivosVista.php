<?php include "Views/Templates/header.php"; ?>

<div class="app-title mx-2">
  <div>
    <h2><i class="fa-solid fa-ban"></i> Inactivos</h2>
  </div>
</div>

<div class="mx-2">
  <a class="btn btn-primary mb-3" href="<?php echo base_url; ?>Vacaciones">
    <i class="fa-solid fa-arrow-left"></i> Volver a Activos
  </a>
</div>

<div class="container-fluid">
  <div class="card-body">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <table class="table table-hover" id="tblInactivosVista">
          <thead class="table-dark">
            <tr>
               <th scope="col">Id</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Fecha</th>
                            <th scope="col">Dias</th>
                            <th scope="col">Descripcion</th>
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

<?php include "Views/Templates/footer.php"; ?>