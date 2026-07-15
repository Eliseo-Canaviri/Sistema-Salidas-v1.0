<?php
class ContratosModel extends Query
{
    private $ci, $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getContratos()
    {
        $sql = "SELECT * FROM contratos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrar( string $sigla,string $nombre)
    {
  
        $this->sigla = $sigla;
        $this->nombre = $nombre;


        $sql = "INSERT INTO contratos(sigla,nombre)VALUES(?,?)";///no funciona
        $datos = array( $this->sigla,$this->nombre);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";

        } else {
            $res = "error";
        }
        return $res;


    }
    public function modificar(string $sigla,string $nombre, int $id)
    {
        
        $this->sigla = $sigla;
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE contratos SET sigla=?,nombre=? WHERE id_contrato=?";
        $datos = array($this->sigla,$this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editar(int $id)
    {
        $sql = "SELECT * FROM contratos WHERE id_contrato=$id";
        $data = $this->select($sql);
        return $data;
    }
    public function accion(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE contratos SET estado=? WHERE id_contrato=?";
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