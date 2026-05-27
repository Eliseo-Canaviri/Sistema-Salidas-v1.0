<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa-solid fa-hand-holding-dollar"></i> Egresos </h2>
    </div>
</div>

<button class="btn btn-primary mb-1 mx-4" type="button" onclick="frmEgresos();">Nuevo <i
        class="fa fa-user-plus"></i></button>
<!--  Tabla de Total Gastos -->
<div class="row mx-4 ">
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label fw-bold ">Total Gastos =</label>
    </div>
    <div class="col-auto px-2 col-md-2 fw-bold">

        <?php foreach ($data['egresos'] as $row) {
        } ?>

        <input type="text" id="inputPassword6" class="form-control ml-4 border border-info "
            value="<?php echo $row['suma_total'] ?> Bs." disabled>
    </div>
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label fw-bold ">Total Ingreso =</label>
    </div>
    <div class="col-auto px-2 col-md-2 fw-bold">

        <?php foreach ($data['ingresos'] as $row) {
        } ?>

        <input type="text" id="inputPassword6" class="form-control ml-4 border border-info "
            value="<?php echo $row['ingreso'] ?> Bs." disabled>
    </div>
</div>
<!-- fin de gastos -->
<!-- table table-dark // para volver la tabla oscuro-->
<div class="row ">
    <div class="col-12">
        <div class="card my-4 mx-3">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center  table-hover  mx-2 mr-2 " id="tblEgresos">
                        <thead class="table-dark ">

                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Gatos (Bs.)</th>
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
<!--  fin tabla-->




<!-- Modal -->
<div class="modal fade" id="nuevo_egresos" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmEgresos">

                    <div class="form-group">
                        <label class="fw-bold" for="gasto">Gasto</label>
                        <input type="hidden" id="id_egreso" name="id_egreso">
                        <input id="gasto" class=" input-group form-control" type="text" name="gasto"
                            placeholder="Ingrese Monto de Gasto">
                    </div>

                    <div class="form-group">
                        <label class="fw-bold" for="descripcion">Descripcion</label>

                        <input id="descripcion" class="form-control" type="text" name="descripcion"
                            placeholder="Ingrese Descripcion">
                    </div>
                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="RegistrarEgresos(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>