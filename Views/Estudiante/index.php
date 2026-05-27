<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa fa-dashboard"></i> Estudiante ♣</h2>
    </div>
</div>
<button class="btn btn-primary mb-1 mx-4" type="button" onclick="frmEstudiante();">Nuevo <i
        class="fa fa-user-plus"></i></button>

<!-- table table-dark // para volver la tabla oscuro-->
<div class="row ">
    <div class="col-12">
        <div class="card my-4 mx-3">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center  table-hover  mx-2 mr-2 " id="tblestudiante">
                        <thead class="table-dark ">

                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Nombre</th>
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
<!--  fin tabla-->




<!-- Modal -->
<div class="modal fade" id="nuevo_estudiante" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmEstudiante">

                    <div class="form-group">
                        <label class="fw-bold" for="ci">Dni</label>
                        <input type="hidden" id="id" name="id">
                        <input id="ci" class=" input-group form-control" type="text" name="ci" placeholder="Dni">
                    </div>

                    <div class="form-group">
                        <label class="fw-bold" for="nombre">Nombre del Estudiante</label>

                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>
                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="registrarUser(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>