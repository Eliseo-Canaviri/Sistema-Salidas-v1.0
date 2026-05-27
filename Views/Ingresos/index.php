<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa-solid fa-wallet"></i> Ingresos</h2>
    </div>
</div>

<div class="mx-4 ">
  <button class="btn btn-primary  mb-3 " type="button" onclick="frmIngreso();">Nuevo <i
        class="fa fa-user-plus"></i></button>
</div>

<!-- table table-dark // para volver la tabla oscuro-->

<!--  fin tabla-->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card">
                <div class="card-body p-4">
                    <table class="table align-items-center  table-hover  mx-2 mr-2 " id="tblIngreso">
                        <thead class="table-dark ">

                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Total</th>
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
</div>



<!-- Modal -->
<div class="modal fade" id="nuevo_ingreso" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmIngreso">

                    <div class="form-group">
                        <label class="fw-bold" for="ingreso">Total Bs.</label>
                        <input type="hidden" id="id_ingreso" name="id_ingreso">
                        <input id="ingreso" class=" input-group form-control" type="number" name="ingreso"
                            placeholder="Ingrese el monto (Bs.)">
                    </div>

                    <div class="form-group">
                        <label class="fw-bold" for="descripcion">Descripcion</label>
                        <input id="descripcion" class="form-control" type="text" name="descripcion"
                            placeholder="Ingrese la Descripcion">
                    </div>
                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="RegistrarIngreso(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>