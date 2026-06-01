<?php
class ChoferesModel extends Query
{
    private $ci, $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getChoferes()
    {
        $sql = "SELECT * FROM choferes ";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarChofer( string $nlicencia, string $nombres, string $categoria)
    {
  
        $this->nlicencia = $nlicencia;
        $this->nombres = $nombres;
        $this->categoria = $categoria;

        $sql = "INSERT INTO choferes(nlicencia, nombres, categoria)VALUES(?, ?, ?)";
        $datos = array($this->nlicencia, $this->nombres, $this->categoria);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";

        } else {
            $res = "error";
        }
        return $res;


    }
    public function modificarChofer(string $nlicencia, string $nombres, string $categoria, int $id)
    {
        
        $this->nlicencia = $nlicencia;
        $this->nombres = $nombres;
        $this->categoria = $categoria;
        $this->id = $id;
        $sql = "UPDATE choferes SET nlicencia=?, nombres=?, categoria=? WHERE id_chofer=?";
        $datos = array($this->nlicencia, $this->nombres, $this->categoria, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editarChofer(int $id)
    {
        $sql = "SELECT * FROM choferes WHERE id_chofer=$id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionChofer(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE choferes SET estado=? WHERE id_chofer=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;



    }

    public function buscarChofer($valor)
    {
        $sql = "SELECT id_chofer, nombres as text FROM choferes WHERE nombres LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
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