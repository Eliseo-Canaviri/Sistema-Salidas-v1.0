<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa fa-dashboard"></i> Vacaciones</h2>
    </div>
</div>
<div>

    <button class="btn btn-primary mb-1" type="button" onclick="frmVacaciones();">Nuevo <i
            class="fa fa-user-plus"></i></button>
    <a class="btn btn-info mb-1   " href="<?php echo base_url; ?>Vacaciones/aprobadosVista"> Aprobado <i
            class="fa-solid fa-user-slash"></i></a>
    <a class="btn btn-warning mb-1   " href="<?php echo base_url; ?>Vacaciones/inactivosVista"> Inactivos <i
            class="fa-solid fa-user-slash"></i></a>
</div>

<!--  Header End -->
<div class="container-fluid">
    <div class="card-body">
        <div class="card">
            <div class="card-body p-4">
                <table class="table  table-hover" id="tblvacacion">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Usuarios</th>
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




<!--  fin tabla-->




<!-- Modal -->
<div class="modal fade" id="nuevo_vacacion" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmVacaciones">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label class="fw-bold" for="fecha_inicio">Fecha Inicio</label>
                        <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio"
                            placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <label class="fw-bold" for="fecha_fin">Fecha Fin</label>
                        <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" placeholder="Nombres">
                    </div>
                    <div class="form-group">
                        <label class="fw-bold" for="dias">Dias</label>
                        <input id="dias" class="form-control" type="number" name="dias" placeholder="0" readonly>
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="registrarVacaciones(event);"
                    id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>