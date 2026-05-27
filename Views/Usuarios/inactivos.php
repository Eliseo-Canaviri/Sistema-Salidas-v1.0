<?php include "Views/Templates/header.php"; ?>
<div class="app-title mx-4">
    <div>
        <h2><i class="fa-solid fa-users-line "></i></i> Usuarios </h2>
    </div>
</div>
<a class="btn btn-primary mb-3 mx-4 " href="<?php echo base_url; ?>Usuarios"><i class="bi bi-reply-all"></i>Regresar
</a>

<!-- table table-dark // para volver la tabla oscuro-->
<div class="row ">
    <div class="col-12">
        <div class="card my-2 mx-3">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-light table-hover mx-4 " id="tblInactivos">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['usuarios'] as $row) {
                                if ($row['estado'] == 0) {
                                    $estado = '<span class="badge bg-danger">Inactivo</span>';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nombre']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['correo']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['usuario']; ?>
                                    </td>

                                    <td>
                                        <?php echo $estado; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" type="button"
                                            onclick="btnReingresarUser(<?php echo $row['id'] ?>);"><i
                                                class="fa-solid fa-trash-can-arrow-up"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "Views/Templates/footer.php"; ?>