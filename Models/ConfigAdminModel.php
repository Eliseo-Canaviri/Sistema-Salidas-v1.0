<?php
class ConfigAdminModel extends Query
{
    //  private $sitios,$nom_usuario,  $notas, $pass,$id,$estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
    public function modificar(string $nombre, string $telefono, string $direccion, string $mensaje, int $id)
    {
        $sql = "UPDATE empresa SET nombre=?, telefono=?, direccion=?, mensaje=? WHERE id=?";
        $datos = array($nombre, $telefono, $direccion, $mensaje, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";

            // code...
        } else {
            $res = "error";
        }
        return $res;
    }

    function verificarPermiso(int $id_user,string $nombre)
    {
        $sql = "SELECT pe.id_permiso , pe.permiso, de.id, de.id_usuario, de.id_permiso FROM permisos pe INNER JOIN detalle_permisos de ON   pe.id_permiso=de.id_permiso  WHERE de.id_usuario=$id_user AND pe.permiso='$nombre' ";
        $data = $this->selectAll($sql);
        return $data;
    }









}
?>