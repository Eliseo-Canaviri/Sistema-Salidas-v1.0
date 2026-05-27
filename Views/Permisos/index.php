<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa-solid fa-key"></i> Permisos ♣</h2>
    </div>
</div>
<div>

<button class="btn btn-primary mb-3 mx-4" type="button" onclick="frmPermisos();">Nuevo <i
        class="fa fa-user-plus"></i></button>
</div>


<!-- table table-dark // para volver la tabla oscuro-->

           
<!--  fin tabla-->

<!--  Header End -->
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="card">
        <div class="card-body p-4">

          <table class="table align-items-center  table-hover  mx-2 mr-2 " id="tblPermisos">
                        <thead class="table-dark ">

                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Permisos</th>
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



<!-- Modal -->
<div class="modal fade" id="nuevo_permisos" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmPermisos">

                    <div class="form-group">
                        <label class="fw-bold" for="permiso">Permiso</label>
                        <input type="hidden" id="id_permiso" name="id_permiso">
                        <input id="permiso" class=" input-group form-control" type="text" name="permiso"
                            placeholder="Ingrese Modulo">
                    </div>

                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="RegistrarPermiso(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>