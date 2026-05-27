<?php
class PermisosModel extends Query
{
    private  $permiso, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function RegistrarPermiso( string $permiso)
    {
  
        $this->permiso = $permiso;


        $sql = "INSERT INTO permisos(permiso)VALUES(?)";
        $datos = array($this->permiso);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";

        } else {
            $res = "error";
        }
        return $res;


    }
    public function modificarEstudiante(string $ci, string $nombre, int $id)
    {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE estudiante SET ci=?, nombre=? WHERE id=?";
        $datos = array($this->ci, $this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editarEstudiante(int $id)
    {
        $sql = "SELECT * FROM estudiante WHERE id=$id";
        $data = $this->select($sql);
        return $data;
    }
    public function ElimiarPermisos( int $id)
    {
        $this->id = $id;
        
      //  DELETE FROM `egresos` WHERE `egresos`.`id_egreso` = 1
        $sql = "DELETE FROM permisos  WHERE id_permiso=?";
        $datos = array( $this->id);
        $data = $this->save($sql, $datos);
        return $data;



    }
    public function accionEstudiante(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE estudiante SET estado=? WHERE id=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;



    }
    public function buscarEstudiante($valor)
    {
        $sql = "SELECT id, ci, nombre as text FROM estudiante WHERE ci LIKE '%" . $valor . "%' AND estado = 1 OR nombre LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT pe.id_permiso , pe.permiso, de.id, de.id_usuario, de.id_permiso FROM permisos pe INNER JOIN detalle_permisos de ON   pe.id_permiso=de.id_permiso  WHERE de.id_usuario=$id_user AND pe.permiso='$nombre' ";
        $data = $this->selectAll($sql);
        return $data;
    }








}
?>