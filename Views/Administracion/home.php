<?php include "Views/Templates/header.php"; ?>

<div class="app-title mx-4 mb-5 mt-2">
    <div>
        <h2><i class="fa fa-dashboard"></i> Panel de Administración</h2>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">

                    <i class="material-icons opacity-10 ">person</i>
                </div>
                <div class="text-end pt-1">

                    <p class="text-sm mb-0 text-capitalize"></p>

                    <a href="<?php echo base_url; ?>Usuarios">
                        <h4 class="mb-0">
                            <span class="mx-4 text-success ">
                                <?php echo $data['usuarios']['total'] ?>
                            </span> Usuarios

                        </h4>

                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-1 ">
                <p class="mb-0 "><span class="text-danger text-sm font-weight-bolder">
                        <h5 class="text-center text-success ">


                            <a href="<?php echo base_url; ?>Usuarios ">
                    </span> Ver Detalle</p></a>
                </h5>
            </div>
        </div>
    </div>
    <!-- fin de Usuarios -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-success text-center border-radius-xl mt-n4 position-absolute">

                    <i class="material-icons opacity-10 ">account_balance_wallet</i>

                </div>
                <div class="text-end pt-1">

                    <p class="text-sm mb-0 text-capitalize"></p>

                    <a href="<?php echo base_url; ?>Ingresos">
                        <h4 class="mb-0">
                            <span class="mx-4 text-info ">
                                <?php echo $data['ingresos']['total'] ?>
                            </span>
                            Ingresos
                        </h4>
                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-1">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        <h5 class="text-center text-info ">
                            <a href="<?php echo base_url; ?>Ingresos ">
                    </span> Ver Detalle</p></a>
                </h5>
            </div>
        </div>
    </div>
    <!-- fin de Ingresos -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-danger shadow-success text-center border-radius-xl mt-n4 position-absolute">

                    <i class="material-icons opacity-10 ">add_shopping_cart</i>

                </div>
                <div class="text-end pt-1">

                    <p class="text-sm mb-0 text-capitalize"></p>

                    <a href="<?php echo base_url; ?>Egresos">
                        <h4 class="mb-0">
                            <span class="mx-4 text-danger ">
                                <?php echo $data['egresos']['total'] ?>
                            </span>
                            Egresos
                        </h4>
                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-1">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        <h5 class="text-center text-dark ">


                            <a href="<?php echo base_url; ?>Egresos ">
                    </span> Ver Detalle</p></a>
                </h5>
            </div>
        </div>
    </div>
    <!-- fin de Egresos -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-success text-center border-radius-xl mt-n4 position-absolute">

                    <i class="material-icons opacity-10 ">key</i>

                </div>
                <div class="text-end pt-1">

                    <p class="text-sm mb-0 text-capitalize"></p>

                    <a href="<?php echo base_url; ?>Permisos">
                        <h4 class="mb-0">
                            <span class="mx-4 text-dark ">
                                <?php echo $data['permisos']['total'] ?>
                            </span>
                            Permisos
                        </h4>
                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-1">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        <h5 class="text-center text-danger ">

                            <a href="<?php echo base_url; ?>Permisos ">
                    </span> Ver Detalle</p></a>
                </h5>
            </div>
        </div>
    </div>

    <!-- fin de permisos -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-warning shadow-success text-center border-radius-xl mt-n4 position-absolute">

                    <i class="material-icons opacity-10 ">edit</i>

                </div>
                <div class="text-end pt-1">

                    <p class="text-sm mb-0 text-capitalize"></p>

                    <a href="<?php echo base_url; ?>Anotes">
                        <h4 class="mb-0">
                            <span class="mx-4 text-dark ">
                                <?php echo $data['anotes']['total'] ?>
                            </span>
                            Anotes
                        </h4>
                    </a>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-1">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        <h5 class="text-center text-danger ">

                            <a href="<?php echo base_url; ?>Anotes ">
                    </span> Ver Detalle</p></a>
                </h5>
            </div>
        </div>
    </div>

    <!-- fin de Anotes -->



</div>



<?php include "Views/Templates/footer.php"; ?>