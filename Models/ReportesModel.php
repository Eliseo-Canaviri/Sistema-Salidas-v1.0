<?php
class ReportesModel extends Query
{
    private $ci, $nombre, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getSalidasPdf(int $id)
    {
        $sql = "SELECT 
    sa.*,
    CONCAT(us.nombres, ' ', us.apellidos) AS nombre_usuario,
    CONCAT(ch.nombres, ' ', ch.apellidos) AS nombre_chofer,
    ca.nombre AS nombre_cargo
FROM salidas AS sa
INNER JOIN usuarios AS us
    ON sa.id_usuario = us.id
INNER JOIN usuarios AS ch
    ON sa.id_chofer = ch.id
INNER JOIN cargos AS ca
    ON us.id_cargo = ca.id_cargo
WHERE sa.id_salida = $id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarCargo(string $nombre)
    {

        $this->nombre = $nombre;


        $sql = "INSERT INTO cargos(nombre)VALUES(?)";///no funciona
        $datos = array($this->nombre);
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
        $sql = "SELECT id_cargo, nombre as text FROM cargos WHERE nombre LIKE '%" . $valor . "%' AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT pe.id_permiso , pe.permiso, de.id, de.id_usuario, de.id_permiso FROM permisos pe INNER JOIN detalle_permisos de ON   pe.id_permiso=de.id_permiso  WHERE de.id_usuario=$id_user AND pe.permiso='$nombre' ";
        $data = $this->selectAll($sql);
        return $data;
    }

   public function buscarFuncionario(string $valor)
    {
        $sql = "SELECT id,ci,nombres FROM usuarios WHERE ci LIKE '%" . $valor . "%' or nombres LIKE'%" . $valor . "%' AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

 public function getReporteSalidasTC($id_usuario,$fecha_inicio,$fecha_fin)
    {
        $sql = "  SELECT sa.id_salida,sa.actividad,sa.lugar,sa.transporte,
        sa.fecha_salida,sa.hora_salida,sa.fecha_llegada,sa.hora_llegada,
        sa.id_chofer,sa.id_usuario,us.nombres,us.apellidos,ca.nombre as nombre_cargo
                FROM salidas AS sa
                INNER JOIN usuarios AS us
                ON sa.id_usuario=us.id
                INNER JOIN cargos as ca 
                ON us.id_cargo=ca.id_cargo
                WHERE sa.fecha_llegada>= '$fecha_inicio'  -- Fecha inicial
                AND sa.fecha_salida <= '$fecha_fin'  -- Fecha final
                AND sa.id_usuario =$id_usuario
                AND sa.estado=1
                AND us.estado=1
                           ";
        $data = $this->selectAll($sql);
        return $data;
    }




}
?>