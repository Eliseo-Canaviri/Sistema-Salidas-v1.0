<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function index()
    {
        if (empty($_SESSION['activo'])) {

            header("location:" . base_url);
        }
        $id_user = $_SESSION['id_usuario'];
        $verificar = $this->model->verificarPermiso($id_user, 'usuarios');
        if (!empty($verificar) || $id_user == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location:' . base_url . 'Errors/permisos');
        }

    }

    public function listar()
    {
        //vamos mandar por json a funciones.js
        //print_r($this->model->getUsuarios());
        //die();

        $data = $this->model->getUsuarios(1);
        for ($i = 0; $i < count($data); $i++) {

            if ($data[$i]['estado'] == 1) {
                if ($data[$i]['id'] != 1) {

                    $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
                    $data[$i]['acciones'] = '<div>
                          <a class ="btn btn-dark" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . ' "><i class="fa-solid fa-key"></i></a>
                <button class ="btn btn-primary" type="button"onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fa-solid fa-user-pen"></i></button>
                <button class ="btn btn-danger" type="button"onclick="btnEliminarUser(' . $data[$i]['id'] . ');" ><i class="fa-solid fa-trash"></i></button>
                <div/>';


                } else {
                    $data[$i]['estado'] = '<span class="badge bg-success">Activo</span>';
                    $data[$i]['acciones'] = '<div class"text-center">
                        <span class="bg-primary p-1 rounded text-white">Super Administrador</span>
                        </div>';
                }



            }
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        //print_r($_POST);
        // die();

        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los Campos estan Vaciones";
            // code...
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash, 1);

            if ($data) {

                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['activo'] = true;
                $msg = "ok";
                // code...
            } else {
                $msg = "Usuario ó Contraseña Incorrecta !!!";
            }

        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

        // code...
    }

    public function registrar()
    {
       
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $id = $_POST['id'];
        $hash = hash("SHA256", $clave);


        if (empty($nombre) || empty($correo) || empty($usuario)) {
            $msg = array('msg' => 'Todos los campos son obligatorios ☻', 'icono' => 'warning');


        } else {
            if ($id == "") {
                if ($clave != $confirmar) {


                    $msg = array('msg' => 'Las Contraseñas no conciden ☻', 'icono' => 'warning');
                } else {
                    $data = $this->model->registrarUsuario($nombre, $correo, $usuario, $hash);
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

    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //le estamos enviando 
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {

            $msg = array('msg' => 'Usuario dado de baja ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al eliminar usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die(); //terminar el proceso
    }

    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {

            $msg = array('msg' => 'Usuario reingresado con exito ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al registrar el usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die(); //terminar el proceso
    }




    public function cambiarPass()
    {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg' => 'Todo los Campos son obligatorios de controlador ☻', 'icono' => 'warning');
        } else {
            if ($nueva != $confirmar) {
                $mensaje = array('msg' => 'Las contraseñas no conciden de controlador ☻', 'icono' => 'warning');

            } else {
                $id = $_SESSION['id_usuario']; //optiniendo el id de la seccion
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash, $id);

                if (!empty($data)) {

                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {

                        $mensaje = array('msg' => 'Contraseña modificada ☻', 'icono' => 'success');
                    } else {

                        $mensaje = array('msg' => 'Erro al modificar contraseña ☻', 'icono' => 'error');
                    }
                } else {

                    $mensaje = array('msg' => 'Las contraseñas actual Incorrecta ☻', 'icono' => 'warning');
                }

            }
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();

        // code...
    }
    public function inactivos()
    {
        //vamos mandar por json a funciones.js
        //print_r($this->model->getUsuarios(0));
        //die();

        $data['usuarios'] = $this->model->getUsuarios(0);
        $this->views->getView($this, "inactivos", $data);

    }
    public function permisos($id)
    {
        if (empty($_SESSION['activo'])) {

            header("location:" . base_url);
        }
        $data['datos'] = $this->model->getpermisos();
        $permisos = $this->model->getDetallPpermisos($id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['id_permiso']] = true;
        }
        $data['id_usuario'] = $id;
        $this->views->getView($this, "permisos", $data);

    }

    function registrarPermisos()
    {
        $msg = '';
        $id_user = $_POST['id_usuario'];
        $eliminar = $this->model->eliminarPermisos($id_user);
        if ($eliminar == 'ok') {
            foreach ($_POST['permisos'] as $id_permisos) {
                $msg = $this->model->registrarPermisos($id_user, $id_permisos);
            }
            if ($msg == 'ok') {
                $msg = array('msg' => ' Permisos Asignados ☻', 'icono' => 'success');

            } else {
                $msg = array('msg' => 'Error al asignar los  permisos  ', 'icono' => 'error');

            }

        } else {
            $msg = array('msg' => 'Error al Elimiar  los permisos anterios ', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }
   


   
















    public function salir()
    {
        session_destroy();
        header("location:" . base_url);
        // code...
    }



}
?>