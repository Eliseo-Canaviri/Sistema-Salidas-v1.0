<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa fa-dashboard"></i> Cargos</h2>
    </div>
</div>
<div>

    <button class="btn btn-primary mb-1 mx-4" type="button" onclick="frmCargos();">Nuevo <i
            class="fa fa-user-plus"></i></button>

</div>



<!--  Header End -->
<div class="container-fluid">
    <div class="card-body">
        <div class="card">
            <div class="card-body p-4">
                <table class="table  table-hover" id="tblcargos">
                    <thead class="table-dark ">

                        <tr>
                            <th scope="col">Id</th>
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




<!--  fin tabla-->




<!-- Modal -->
<div class="modal fade" id="nuevo_cargo" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCargos">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label class="fw-bold" for="nombre">Nombre del Cargo</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>
                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="registrarCargos(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>