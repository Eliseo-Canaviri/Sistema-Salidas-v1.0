<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1 class="fw-bold "><i class="fa fa-dashboard "></i> Reportes Por Salidas </h1>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
          
        </h5>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- ===== FORMULARIO ENTRADAS ===== -->
            <div class="col-md-6">
                <form id="frmEntradas"
                    action="<?= base_url ?>Reportes/FechaFuncionarioPdf"
                    method="POST"
                    target="_blank">

                    <div class="text-center mb-4">
                        <h6 class="text-danger fw-bold">
                            <i class="bi bi-box-arrow-in-down"></i> Reporte por Fechas 
                        </h6>
                    </div>

                    <!-- funcionarios -->
                    <div class="mb-3">
                        <input type="text" id="id_usuario" name="id_usuario">

                        <div class="form-floating">
                            <input class="form-control"
                                id="select_funcioanariopdf"
                                type="text"
                                placeholder="Buscar Funcionario">
                            <label>Buscar Funcionario </label>
                        </div>
                    </div>
                  

                    <!-- FECHAS EN UNA FILA -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control"
                                    type="date"
                                    id="fecha_inicio_ingreso"
                                    name="fecha_inicio"
                                    value="<?= date('Y-m-d') ?>"
                                    required>
                                <label>Fecha Inicio</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control"
                                    type="date"
                                    id="fecha_fin_ingreso"
                                    name="fecha_fin"
                                    value="<?= date('Y-m-d') ?>"
                                    required>
                                <label>Fecha Fin</label>
                            </div>
                        </div>
                    </div>

                    <!-- BOTÓN -->
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-file-earmark-pdf"></i> Ver Reporte
                    </button>
                </form>
            </div>
            <!-- ===== FORMULARIO SALIDAS ===== -->
         

        </div>
    </div>
</div>




















<?php include "Views/Templates/footer.php"; ?>