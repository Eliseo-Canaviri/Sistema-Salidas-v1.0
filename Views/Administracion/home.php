<?php include "Views/Templates/header.php"; ?>

<div class="container-fluid px-4 mt-4 mb-5">
    <div class="d-flex align-items-center justify-content-between pb-3 border-bottom">
        <div>
            <h2 class="fw-bold text-dark m-0 d-flex align-items-center gap-2">
                <i class="fa fa-dashboard text-primary"></i> Panel de Administración
            </h2>
            <p class="text-muted small m-0 mt-1">Monitoreo general del sistema</p>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="row g-4">
        
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 position-relative overflow-hidden transition-hover">
                <div class="position-absolute top-0 bottom-0 start-0 bg-success" style="width: 5px;"></div>
                
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar avatar-lg rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="fa-solid fa-person-walking-arrow-right fs-4"></i>
                        </div>
                        <div class="text-end">
                            <p class="text-muted text-uppercase small fw-bold mb-1">Total Salidas</p>
                            <h2 class="fw-extrabold text-dark m-0">
                                <?php echo $data['salidas']['total'] ?? 0; ?>
                            </h2>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light bg-opacity-50 border-0 py-3 px-4">
                    <a href="<?php echo base_url; ?>Salidas" class="text-decoration-none text-success d-flex align-items-center justify-content-between small fw-semibold link-animated">
                        <span>Ver detalle de salidas</span>
                        <i class="fa-solid fa-arrow-right transition-icon"></i>
                    </a>
                </div>
            </div>
        </div>

        </div>
</div>


<?php include "Views/Templates/footer.php"; ?>