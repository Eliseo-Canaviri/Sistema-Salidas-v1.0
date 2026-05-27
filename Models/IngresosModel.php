<?php
class IngresosModel extends Query
{
    private $ingreso, $descripcion, $id_ingreso,$id_usuario, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getIngresos(int $id_usuario)
    {
        $sql = "SELECT * FROM ingresos WHERE id_usuario=$id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function RegistrarIngresos(string $ingreso, string $descripcion ,int  $id_usuario)
    {
        $this->ingreso =$ingreso;
        $this->descripcion = $descripcion;
        $this->id_usuario= $id_usuario;


        $sql = "INSERT INTO ingresos(ingreso,descripcion,id_usuario)VALUES(?,?,?)";///no funciona
        $datos = array($this->ingreso, $this->descripcion,$this-> id_usuario );
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