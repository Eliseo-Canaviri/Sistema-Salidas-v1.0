<?php include "Views/Templates/header.php"; ?>
<div class="app-title ">
    <div>
        <h2><i class="fa fa-dashboard"></i> Choferes</h2>
    </div>
</div>
<div>

    <button class="btn btn-primary mb-2 " type="button" onclick="frmChoferes();">Nuevo <i
            class="fa fa-user-plus"></i></button>

</div>



<!--  Header End -->
<div class="container-fluid">
    <div class="card-body">
        <div class="card">
            <div class="card-body p-4">
                <table class="table  table-hover" id="tblchoferes">
                    <thead class="table-dark ">

                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">N° Licencia</th>
                            <th scope="col">Nombres Completo</th>
                            <th scope="col">Categoria</th>
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
<div class="modal fade" id="nuevo_chofer" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Título del modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="frmChoferes">
                    <div class="form-group mb-3">
                        <input type="hidden" id="id" name="id">

                        <label for="nlicencia" class="form-label fw-bold">
                            <i class="fas fa-id-card me-1"></i>
                            Número de Licencia
                        </label>

                        <input type="text" id="nlicencia" name="nlicencia" class="form-control text-dark"
                            placeholder="Ej: 12345678" autocomplete="off" oninput="this.value = this.value.toUpperCase();"   required>

                        <small class="text-muted">
                            Ingrese el número de licencia exactamente como figura en el documento.
                        </small>
                    </div>
                    <div class="form-group mb-3">
                        <input type="hidden" id="id" name="id">

                        <label for="nombres" class="form-label fw-bold" >
                            <i class="fas fa-id-card me-1"></i>
                            Nombre Completo del Chofer
                        </label>

                        <input type="text" id="nombres" name="nombres" class="form-control"
                            placeholder="Ej: LUIS MAMANI TOLA" autocomplete="off"
                            oninput="this.value = this.value.toUpperCase();" required>

                        <small class="text-muted">
                            Ingrese nombres y apellidos completos según la licencia de conducir.
                        </small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">

                        <label class="fw-bold" for="categoria">
                            Categoría de Licencia
                        </label>

                        <select id="categoria" name="categoria" class="form-select" required>
                            <option value="" selected disabled>
                                Seleccione una categoría
                            </option>

                            <option value="M">M - Motocicletas</option>
                            <option value="P">P - Particular</option>
                            <option value="A">A - Servicio Público</option>
                            <option value="B">B - Servicio Público Profesional</option>
                            <option value="C">C - Transporte Pesado</option>
                        </select>

                        <small class="text-muted">
                            Seleccione la categoría según la licencia de conducir.
                        </small>
                    </div>



                </form>
            </div>
            <div class="modal-body ">
                <button type="button" class="btn btn-primary" onclick="registrarChoferes(event);"
                    id="btnAccion">Registrar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin de Modal -->

<?php include "Views/Templates/footer.php"; ?>