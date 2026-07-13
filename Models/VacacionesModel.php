<?php
class VacacionesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todas las salidas activas o inactivas
    public function getVacaciones(int $id_usuario, int $estado)
    {
        $sql = "SELECT *
                FROM vacaciones
                WHERE estado = $estado AND id_usuario =$id_usuario";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getVacaionesadmin($estado)
    {
        $sql = "SELECT*
                FROM vacaciones
                WHERE estado = $estado  ";
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
    public function getEditar(int $id_salida)
    {
        $sql = "SELECT *

            FROM vacaciones 
            WHERE id_vacacion =  $id_salida";
        $data = $this->select($sql);
        return $data;
    }

    // Registrar nueva salida
    public function registrar(int $id_usuario, string $fecha_inicio, string $fecha_fin, string $dias, string $descripcion)
    {
        $sql = "INSERT INTO vacaciones ( id_usuario,fecha_inicio, fecha_fin, dias, descripcion)     VALUES (?, ?, ?, ?,?)";
        $datos = array($id_usuario, $fecha_inicio, $fecha_fin, $dias, $descripcion);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            return "ok";
        } else {
            return "error";
        }
    }

    // Modificar una salida existente
    public function modificar(int $id_usuario ,string $fecha_inicio, string $fecha_fin, string $dias, string $descripcion, int $id_vacacion)
    {


        $sql = "UPDATE vacaciones SET id_usuario=?, fecha_inicio=?, fecha_fin=?, dias=?, descripcion=? WHERE id_vacacion=?";
        $datos = array($id_usuario, $fecha_inicio, $fecha_fin, $dias, $descripcion, $id_vacacion);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            return "modificado";
        } else {
            return "error";
        }
    }

    // Cambiar estado (activar/desactivar)
    public function accionVacaciones(int $estado, int $id_salida)
    {
        $sql = "UPDATE vacaciones SET estado=? WHERE id_vacacion=?";
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

    function MaxIdVacacion()
    {
        $sql = "SELECT MAX(id_vacacion) AS id_vacacion FROM vacaciones";
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