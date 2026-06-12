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
            $data['unidades'] = $this->model->getUnidades(1);
            $data['cargos'] = $this->model->getCargos(1);

            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' . base_url . 'Errors/permisos');
        }

    }
    function registrarse()
    {
        $data['unidades'] = $this->model->getUnidades(1);
        $data['cargos'] = $this->model->getCargos(1);
        $this->views->getView($this, "registro", $data);
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
                          <a class ="btn btn-dark btn-sm" href="' . base_url . 'Usuarios/permisos/' . $data[$i]['id'] . ' "><i class="fa-solid fa-key"></i></a>
                <button class ="btn btn-primary btn-sm" type="button"onclick="btnEditarUser(' . $data[$i]['id'] . ');"><i class="fa-solid fa-user-pen"></i></button>
                <button class ="btn btn-danger btn-sm" type="button"onclick="btnEliminarUser(' . $data[$i]['id'] . ');" ><i class="fa-solid fa-trash"></i></button>
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
                $_SESSION['ci'] = $data['ci'];
                $_SESSION['nombres'] = $data['nombres'];
                $_SESSION['apellidos'] = $data['apellidos'];
                $_SESSION['celular'] = $data['celular'];
                $_SESSION['id_cargo'] = $data['id_cargo'];
                $_SESSION['id_unidad'] = $data['id_unidad'];
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
    public function registroPrincipal()
    {
        // print_r($_POST);
        //die();
        $ci = $_POST['ci'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $celular = $_POST['celular'];
        $id_cargo = $_POST['id_cargo'];
        $id_unidad = $_POST['id_unidad'];
        $select_cargo = $_POST['select_cargo'];
        $select_unidad = $_POST['select_unidad'];

        $id = $_POST['id'];

        if (empty($ci) || empty($nombres) || empty($apellidos)) {
            $msg = array('msg' => 'Todos los campos son obligatorios ☻', 'icono' => 'warning');
        } else {
            if ($id == "") {

                // El código solo entra si AMBOS están vacíos
                if (empty($id_cargo) && empty($id_unidad)) {
                    // Guardamos los resultados en variables diferentes para no perder información
                    $resCargo = $this->model->registrarCargo($select_cargo);
                    $resUnidad = $this->model->registrarUnidad($select_unidad);
                   
                } else {
                    // Opcional: por si intentan enviar datos cuando deberían estar vacíos
                    $data = "Error: Los campos no están vacíos.";
                }
               // $datac = $this->model->getMaxIdCargo();
              //  $datac = $this->model->getMaxIdCargo();
               
               
                // Generar clave: inicial de nombre + inicial de apellido + CI
                $inicialNombre = strtoupper(substr(trim($nombres), 0, 1));
                $inicialApellido = strtoupper(substr(trim($apellidos), 0, 1));
                $claveTexto = $inicialNombre . $inicialApellido . $ci;
                $clave = hash("SHA256", $claveTexto);
                $data = $this->model->registrarUsuario($ci, $nombres, $apellidos, $celular, $id_cargo, $id_unidad, $clave, $clave);
                if ($data == "ok") {
                    $dataus = $this->model->getMaxIdUsuario();
                    foreach ($dataus as $row) {
                        $id_usuario = $row;
                    }

                    $datau = $this->model->registrarPermisos($id_usuario, 15);



                    $msg = array(
                        'msg' => '¡Usuario registrado con éxito!<br><br>' . '<b>Usuario:</b> ' . $ci . '<br>' . '<b>Contraseña:</b> ' . $claveTexto,
                        'icono' => 'success'
                    );
                } else if ($data == "existe") {

                    $msg = array('msg' => 'El Usuario ya Existe ☻', 'icono' => 'warning');
                } else {

                    $msg = array('msg' => 'Error al registrar al usuario ☻', 'icono' => 'error');
                }
            }
            #code ..
            else {
                $data = $this->model->modificarUsuario($ci, $nombres, $apellidos, $celular, $id);
                if ($data == "modificado") {

                    $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
                } else {

                    $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
                }
            }


            echo json_encode($msg, JSON_UNESCAPED_UNICODE); //enviando ala archivo funcion js
            die();

        }
    }

    public function registrar()
    {
        //  print_r($_POST);
        //    die();
        $ci = $_POST['ci'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $celular = $_POST['celular'];
        $id_cargo = $_POST['id_cargo'];
        $id_unidad = $_POST['id_unidad'];

        $id = $_POST['id'];


        if (empty($ci) || empty($nombres) || empty($apellidos)) {
            $msg = array('msg' => 'Todos los campos son obligatorios ☻', 'icono' => 'warning');


        } else {
            if ($id == "") {

                // Generar clave: inicial de nombre + inicial de apellido + CI
                $inicialNombre = strtoupper(substr(trim($nombres), 0, 1));
                $inicialApellido = strtoupper(substr(trim($apellidos), 0, 1));
                $claveTexto = $inicialNombre . $inicialApellido . $ci;
                $clave = hash("SHA256", $claveTexto);
                $data = $this->model->registrarUsuario($ci, $nombres, $apellidos, $celular, $id_cargo, $id_unidad, $clave, $clave);
                if ($data == "ok") {

                    $msg = array('msg' => 'Usuario registrado con éxito. Clave generada: ' . $claveTexto . ' ☻', 'icono' => 'success');
                } else if ($data == "existe") {

                    $msg = array('msg' => 'El usuario ya existe ☻', 'icono' => 'warning');
                } else {

                    $msg = array('msg' => 'Error al registrar al usuario ☻', 'icono' => 'error');
                }
            }
            #code ..
            else {
                $data = $this->model->modificarUsuario($ci, $nombres, $apellidos, $celular, $id_cargo, $id_unidad, $id);
                if ($data == "modificado") {

                    $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
                } else {

                    $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
                }
            }


            echo json_encode($msg, JSON_UNESCAPED_UNICODE); //enviando ala archivo funcion js
            die();

        }
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

            // Verificar si llegan permisos
            if (isset($_POST['permisos']) && is_array($_POST['permisos'])) {

                foreach ($_POST['permisos'] as $id_permisos) {
                    $msg = $this->model->registrarPermisos($id_user, $id_permisos);
                }

                if ($msg == 'ok') {
                    $msg = array(
                        'msg' => 'Permisos Asignados ☻',
                        'icono' => 'success'
                    );

                } else {
                    $msg = array(
                        'msg' => 'Error al asignar permisos',
                        'icono' => 'error'
                    );
                }

            } else {

                $msg = array(
                    'msg' => 'Debe seleccionar al menos un permiso',
                    'icono' => 'warning'
                );
            }

        } else {

            $msg = array(
                'msg' => 'Error al eliminar permisos anteriores',
                'icono' => 'error'
            );
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }



    function perfil()
    {
        // $this->views->getView($this, "perfil");
        $id_user = $_SESSION['id_usuario'];
        /// $data['unidades'] = $this->model->getUnidades(1);
        //  $data['cargos'] = $this->model->getCargos(1);
        $data['usuarios'] = $this->model->editarUserPerfil($id_user);
        $this->views->getView($this, "perfil", $data);
    }
    public function actualizarDatosUsuario()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }

        //   print_r($_POST);
        ///            die();

        $ci = ($_POST['ci']);
        $nombres = ($_POST['nombres']);
        $apellidos = ($_POST['apellidos']);
        $celular = ($_POST['celular']);
        // $id_cargo = ($_POST['perfil_cargo']);
        // $id_unidad = ($_POST['perfil_unidad']);

        $id = $_SESSION['id_usuario'];

        if ($id == "") {

            $msg = array('msg' => 'Error al Modificar ☻', 'icono' => 'warning');

        }
        $data = $this->model->modificarUsuario($ci, $nombres, $apellidos, $celular, $id);
        if ($data == "modificado") {

            $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }















    public function salir()
    {
        session_destroy();
        header("location:" . base_url);
        // code...
    }



}
?>