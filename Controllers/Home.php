<?php
class Home extends Controller
{
    public function __construct()
    {
        session_start();
        if (!empty($_SESSION['activo'])) {
            // code...
            header("location:" . base_url . "Usuarios");
        }
        parent::__construct();
    }
    public function index()
    {

        $this->views->getView($this, "index");
    }
    public function registrar()
    {

        $this->views->getView($this, "registrar");
    }
    public function RegistrarVista()
    {
        //print_r($_POST);
       // die();

        $nombre = $_POST['nombre'];
        $correo = $_POST['email'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);
        $id_rol = 2; //por defecto el usuario 

        if (empty($nombre) || empty($correo) || empty($usuario)) {
            $msg = array('msg' => 'Todos los campos son obligatorios ☻', 'icono' => 'warning');
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {


                    $msg = array('msg' => 'Las Contraseñas no conciden ☻', 'icono' => 'warning');
                } else {
                    $data = $this->model->RegistrarUsuarioVista($nombre, $correo, $usuario, $hash, $id_rol);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Usuario registrado con exito ☻', 'icono' => 'success');
                    } else if ($data == "existe") {

                        $msg = array('msg' => 'El usuario ya existe ☻', 'icono' => 'warning');
                    } else {

                        $msg = array('msg' => 'Error al registrar al usuario ☻', 'icono' => 'error');
                    }
                }
                #code ..

            } else {
                $data = $this->model->modificarUsuario($nombre, $correo, $usuario, $id);
                if ($data == "modificado") {

                    $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
                } else {

                    $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //enviando ala archivo funcion js
        die();
    }
}
