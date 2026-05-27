<?php include "Views/Templates/header.php"; ?>


<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="card">
        <div class="card-body p-4">

      <div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header text-center bg-primary ">
                <h4 class="text-white"> Asignar Permisos</h4>
            </div>
            <div class="card-body">

                <form id="formulario" onsubmit="registrarPermisos(event)">
                    <div class="row">
                        <?php foreach ($data['datos'] as $row) { ?>
                            <div class="col-md-4 align-content-center text-capitalize p-2 form-check form-switch ">
                                <label class="fw-bold fs-5 text">
                                    <?php echo $row['permiso']; ?>
                                </label> <br />
                                <input class=" form-check-input ms-auto " type="checkbox" name="permisos[]"
                                    value="<?php echo $row['id_permiso']; ?>" <?php echo isset($data['asignados'][$row['id_permiso']]) ? 'checked' : ''; ?>>
                            </div>
                        <?php } ?>
                        <input type="hidden" name="id_usuario" value="<?php echo $data['id_usuario']; ?>">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ">
                            Asignar permiso
                        </button>
                        <a class="btn btn-danger" href="<?php echo base_url; ?>Usuarios">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "Views/Templates/footer.php"; ?>