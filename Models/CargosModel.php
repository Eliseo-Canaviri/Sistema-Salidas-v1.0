<?php
class CargosModel extends Query
{
    private $ci, $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getCargos()
    {
        $sql = "SELECT * FROM cargos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCargo( string $nombre)
    {
  
        $this->nombre = $nombre;


        $sql = "INSERT INTO cargos(nombre)VALUES(?)";///no funciona
        $datos = array( $this->nombre);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";

        } else {
            $res = "error";
        }
        return $res;


    }
    public function modificarCargo(string $nombre, int $id)
    {
        
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE cargos SET nombre=? WHERE id_cargo=?";
        $datos = array($this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editarCargo(int $id)
    {
        $sql = "SELECT * FROM cargos WHERE id_cargo=$id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionCargo(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE cargos SET estado=? WHERE id_cargo=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;



    }

    public function buscarCargo($valor)
    {
        $sql = "SELECT id_cargo, nombre FROM cargos WHERE nombre LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function verificarPermiso(int $id_user,string $nombre)
    {
        $sql = "SELECT pe.id_permiso , pe.permiso, de.id, de.id_usuario, de.id_permiso FROM permisos pe INNER JOIN detalle_permisos de ON   pe.id_permiso=de.id_permiso  WHERE de.id_usuario=$id_user AND pe.permiso='$nombre' ";
        $data = $this->selectAll($sql);
        return $data;
    }








}
?>