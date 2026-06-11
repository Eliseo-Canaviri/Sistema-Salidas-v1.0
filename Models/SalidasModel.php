<?php
class SalidasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todas las salidas activas o inactivas
    public function getSalidas(int $id_usuario, int $estado)
    {
        $sql = "SELECT s.id_salida, s.id_usuario, 
                       CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario,
                       s.actividad, s.lugar, s.transporte,
                       s.fecha_salida, s.hora_salida,s.fecha_llegada, s.hora_llegada,
                       s.estado, s.fecha_registro
                FROM salidas s
                INNER JOIN usuarios u ON s.id_usuario = u.id
               

                WHERE s.estado = $estado AND s.id_usuario = $id_usuario
                ORDER BY s.id_salida DESC";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getSalidasadmin( $estado)
    {
        $sql = "SELECT s.id_salida, s.id_usuario, 
                       CONCAT(u.nombres, ' ', u.apellidos) AS nombre_usuario,
                       s.actividad, s.lugar, s.transporte,
                       s.fecha_salida, s.hora_salida,s.fecha_llegada, s.hora_llegada,
                       s.estado, s.fecha_registro
                FROM salidas s
                INNER JOIN usuarios u ON s.id_usuario = u.id
                WHERE s.estado = $estado 
                ORDER BY s.id_salida DESC";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT *         
            FROM usuarios 
            WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    // Obtener una salida por id
    public function getSalidaEditar(int $id_salida)
    {
        $sql = "SELECT sa.* ,ch.nombres,ch.id_chofer

            FROM salidas as sa 
            INNER JOIN choferes as ch 
            ON  sa.id_chofer=ch.id_chofer

            WHERE sa.id_salida =  $id_salida";
        $data = $this->select($sql);
        return $data;
    }

    // Registrar nueva salida
    public function registrarSalida(string $actividad, string $lugar, string $transporte, string $fecha_salida, string $hora_salida, string $fecha_llegada, string $hora_llegada, int $id_chofer, int $id_usuario)
    {
        $sql = "INSERT INTO salidas ( actividad, lugar, transporte, fecha_salida, hora_salida,fecha_llegada, hora_llegada,id_chofer, id_usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        $datos = array($actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $fecha_llegada, $hora_llegada, $id_chofer, $id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            return "ok";
        } else {
            return "error";
        }
    }

    // Modificar una salida existente
    public function modificarSalida(string $actividad, string $lugar, string $transporte, string $fecha_salida, string $hora_salida, string $fecha_llegada, string $hora_llegada, int $id_chofer, int $id_usuario, int $id_salida)
    {
        $sql = "UPDATE salidas SET  actividad=?, lugar=?, transporte=?, fecha_salida=?, hora_salida=?, fecha_llegada=?, hora_llegada=?,id_chofer=?, id_usuario=? WHERE id_salida=?";
        $datos = array($actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $fecha_llegada, $hora_llegada, $id_chofer, $id_usuario, $id_salida);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            return "modificado";
        } else {
            return "error";
        }
    }

    // Cambiar estado (activar/desactivar)
    public function accionSalida(int $estado, int $id_salida)
    {
        $sql = "UPDATE salidas SET estado=? WHERE id_salida=?";
        $datos = array($estado, $id_salida);
        $data = $this->save($sql, $datos);
        return $data;
    }

    // Obtener funcionarios activos para el select
    public function getFuncionarios()
    {
        $sql = "SELECT id, ci, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM usuarios WHERE estado=1 ORDER BY nombres ASC";
        $data = $this->selectAll($sql);
        return $data;
    }

    function MaxIdSalida()
    {
        $sql = "SELECT MAX(id_salida) AS id_salida FROM salidas";
        $data = $this->select($sql);
        return $data;
    }



    // Verificar permisos (reutilizamos el mismo método que en UsuariosModel)
    function verificarPermiso(int $id_user, string $nombre)
    {
        $sql = "SELECT pe.id_permiso, pe.permiso, de.id, de.id_usuario, de.id_permiso 
                FROM permisos pe 
                INNER JOIN detalle_permisos de ON pe.id_permiso = de.id_permiso 
                WHERE de.id_usuario = $id_user AND pe.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>