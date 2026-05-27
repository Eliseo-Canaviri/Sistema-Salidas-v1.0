<?php
class HomeModel extends Query{
    private $nombre, $correo, $usuario, $clave, $id,$id_rol, $estado;
    public function __construct()
    {
        parent::__construct();
        
    }
    public function RegistrarUsuarioVista(string $nombre, string $correo, string $usuario, string $clave, int $id_rol)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->id_rol= $id_rol;
        //para verificar si existe usuario
        $verificar = "SELECT *FROM usuarios WHERE usuario='$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(nombre, correo, usuario, clave,id_rol) VALUES (?,?,?,?,?)";
            $datos = array($this->nombre, $this->correo, $this->usuario, $this->clave,$this->id_rol);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
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
}

?>