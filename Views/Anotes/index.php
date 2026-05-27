<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa-solid fa-pencil"></i> Anotes ♣</h2>
    </div>
</div>
<button class="btn btn-primary mb-1 mx-4" type="button" onclick="frmAnotes();">Nuevo <i
        class="fa fa-user-plus"></i></button>

<!-- table table-dark // para volver la tabla oscuro-->
<div class="row ">
    <div class="col-12">
        <div class="card my-4 mx-3">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center  table-hover  mx-2 mr-2 " id="tblAnotes">
                        <thead class="table-dark ">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha</th>
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
<!--  fin tabla   -->




<!-- Modal -->
<div class="modal fade" id="nuevo_anotes" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmAnotes">

                    <div class="form-group">
                        <label class="fw-bold" for="titulo">Titulo</label>
                        <input type="hidden" id="id_anote" name="id_anote">
                        <input id="titulo" class=" input-group form-control" type="text" name="titulo"
                            placeholder="Ingrese Titulo">
                    </div>
                    <div class="form-group">
                        <label class="fw-bold" for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="RegistrarAnotes(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>