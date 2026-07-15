<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa fa-dashboard"></i> Tipo de Contrato</h2>
    </div>
</div>
<div>

    <button class="btn btn-primary mb-1 mx-4" type="button" onclick="frmContratos();">Nuevo <i
            class="fa fa-user-plus"></i></button>

</div>



<!--  Header End -->
<div class="container-fluid">
    <div class="card-body">
        <div class="card">
            <div class="card-body p-4">
                <table class="table  table-hover" id="tblcontrato">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Sigla</th>
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
<div class="modal fade" id="nuevo_contrato" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCargos">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label class="fw-bold" for="sigla">Sigla</label>
                        <input id="sigla" class="form-control" type="text" name="sigla" placeholder="Sigla">
                    </div>

                    <div class="form-group">
                        <label class="fw-bold" for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="nombre">
                    </div>


                </form>
            </div>





            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="registrarContratos(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>