<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
  <div>
    <h2><i class="fa-solid fa-users-line "></i></i> Usuarios </h2>
  </div>
</div>

<div class="mx-4">
  <button class="btn btn-primary mb-3" type="button" onclick="frmUsuario();">Nuevo <i
      class="fa-solid fa-user-plus"></i></button>

  <a class="btn btn-warning mb-3 mx-1  " href="<?php echo base_url; ?>Usuarios/inactivos"> Inactivos <i
      class="fa-solid fa-user-slash"></i></a>
</div>


<!-- table table-dark // para volver la tabla oscuro-->

<!--  Header End -->
<div class="container-fluid">
  <div class="card">
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
                <th scope="col">Clave</th>
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
</div>





<div class="modal fade" id="nuevo_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary ">
        <h5 class="modal-title text-white" id="title">Registrar Nuevo Usuario</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <form method="POST" id="frmUsuario">
          <input type="hidden" id="id" name="id">

          <!-- Campo Nombre -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>
          </div>

          <!-- Campo Correo -->
          <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="usuario@ejemplo.com" required>
          </div>

          <!-- Campo Usuario -->
          <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario único" required>
          </div>

          <!-- Fila para Clave y Confirmar (2 columnas) -->
          <div class="row g-3" id="claves">
            <div class="col-md-6">
              <label for="clave" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="clave" name="clave" placeholder="Mínimo 6 caracteres" required>
            </div>
            <div class="col-md-6">
              <label for="confirmar" class="form-label">Confirmar contraseña</label>
              <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Repite la contraseña" required>
            </div>
          </div>
        </form>
      </div> <!-- /.modal-body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>


<?php include "Views/Templates/footer.php"; ?>