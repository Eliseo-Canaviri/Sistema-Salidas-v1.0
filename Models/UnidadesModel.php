<?php
class UnidadesModel extends Query
{
    private $ci, $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getUnidades()
    {
        $sql = "SELECT * FROM unidades";
        $data = $this->selectAll($sql);
        return $data;
    }
  
    public function registrarUnidad( string $nombre)
    {
  
        $this->nombre = $nombre;


        $sql = "INSERT INTO unidades(nombre)VALUES(?)";///no funciona
        $datos = array( $this->nombre);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";

        } else {
            $res = "error";
        }
        return $res;


    }
    public function modificarUnidad(string $nombre, int $id)
    {
        
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE unidades SET nombre=? WHERE id_unidad=?";
        $datos = array($this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editarUnidad(int $id)
    {
        $sql = "SELECT * FROM unidades WHERE id_unidad=$id";
        $data = $this->select($sql);
        return $data;
    }
    
    public function accionUnidad(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE unidades SET estado=? WHERE id_unidad=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;



    }

    public function buscarUnidad($valor)
    {
        $sql = "SELECT id_unidad, nombre  FROM unidades WHERE nombre LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
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