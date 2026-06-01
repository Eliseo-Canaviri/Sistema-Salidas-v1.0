<?php
class UsuariosModel extends Query
{
    private $nombre, $correo, $usuario, $clave, $id, $id_rol, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $ci, string $clave, int $estado)
    {
        $sql = "SELECT * FROM usuarios WHERE ci='$ci' AND clave='$clave' AND estado=$estado ";
        $data = $this->select($sql);
        return $data;
    }

    public function getUsuarios($estado)
    {
        $sql = "SELECT * FROM usuarios WHERE estado= $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getUnidades($estado)
    {
        $sql = "SELECT * FROM unidades WHERE estado= $estado";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getCargos($estado)
    {
        $sql = "SELECT * FROM cargos WHERE estado= $estado";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario(string $ci, string $nombres, string $apellidos, int $celular, int $id_cargo, int $id_unidad, string $clave)
    {
        $this->ci = $ci;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->celular = $celular;
        $this->id_cargo = $id_cargo;
        $this->id_unidad = $id_unidad;
        $this->clave = $clave;
        //para verificar si existe usuario
        $verificar = "SELECT *FROM usuarios WHERE ci='$this->ci'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(ci, nombres, apellidos, celular, id_cargo, id_unidad, clave) VALUES (?,?,?,?,?,?,?)";
            $datos = array($this->ci, $this->nombres, $this->apellidos, $this->celular, $this->id_cargo, $this->id_unidad, $this->clave);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }


        return $res;
        //este meotodo vamos llamar desde nuestro controlador usuario

    }

    public function modificarUsuario(string $ci, string $nombres, string $apellidos, int $celular, int $id_cargo, int $id_unidad, int $id)
    {
        $this->ci = $ci;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->celular = $celular;
        $this->id_cargo = $id_cargo;
        $this->id_unidad = $id_unidad;
        $this->id = $id;
        //para verificar si existe usuario
        $sql = "UPDATE  usuarios SET ci=?, nombres=?, apellidos=?, celular=?, id_cargo=?, id_unidad=? WHERE id=?";
        $datos = array($this->ci, $this->nombres, $this->apellidos, $this->celular, $this->id_cargo, $this->id_unidad, $this->id);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }



        return $res;
        //este meotodo vamos llamar desde nuestro controlador usuario

    }

    public function editarUser(int $id)
    {//este metodo vamos llamar de controlador
        $sql = "SELECT * FROM usuarios WHERE id= $id";
        $data = $this->select($sql);

        return $data;
    }
    public function getPass(string $clave, int $id)
    {//este metodo vamos llamar de controlador
        $sql = "SELECT * FROM usuarios WHERE clave= '$clave' AND id= $id";
        $data = $this->select($sql);

        return $data;
    }

    public function accionUser(int $estado, int $id)
    {
        // code...
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado= ? WHERE id=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function modificarPass(string $clave, int $id)
    {

        $sql = "UPDATE usuarios SET clave= ? WHERE id=?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        return $data;
        // code...
    }

    public function getpermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    function registrarPermisos(int $id_user, int $id_permiso)
    {
        $sql = "INSERT INTO detalle_permisos (id_usuario,id_permiso) VALUES(?,?)";
        $datos = array($id_user, $id_permiso);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = "error";
        }
        return $res;
    }

    function eliminarPermisos(int $id_user)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario=?";
        $datos = array($id_user);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = 'ok';
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUserPerfil(int $id)
    {//este metodo vamos llamar de controlador
        $sql = "SELECT us.*,ca.nombre as nombre_cargo,un.nombre as nombre_unidad

                FROM usuarios as us 
                INNER JOIN cargos as ca 
                ON us.id_cargo=ca.id_cargo
                INNER JOIN unidades as un 
                ON us.id_unidad=un.id_unidad

                WHERE us.id= $id";
        $data = $this->select($sql);

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

  function getMaxIdCargo()
    {
        $sql = "SELECT MAX(id_cargo) AS id_cargo FROM cargos";
        $data = $this->select($sql);
        return $data;
    }
  function getMaxIdUnidad()
    {
        $sql = "SELECT MAX(id_unidad) AS id_unidad FROM unidades";
        $data = $this->select($sql);
        return $data;
    }



























    public function getDetallPpermisos(int $id_user)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario=$id_user";
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