<?php
class Salidas extends Controller
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
        $verificar = $this->model->verificarPermiso($id_user, 'salidas');
        if (!empty($verificar) || $id_user == 1) {
            $data['funcionarios'] = $this->model->getFuncionarios();
            $data['usuarios'] = $this->model->getUsuarios();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' . base_url . 'Errors/permisos');
        }
    }

    // Listar salidas activas vía AJAX para DataTable
    public function listar()
    {
        $id_user = $_SESSION['id_usuario'];

        // Administradores (ID 1 y 2)
        if ($id_user == 1 || $id_user == 2) {
            $data = $this->model->getSalidasadmin(1); // Todas las salidas

        } else {
            $data = $this->model->getSalidas($id_user, 1); // Solo sus salidas
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div class="d-flex gap-1">
            
             <button class="btn btn-sm btn-primary px-3 py-2" type="button" onclick="btnEditarSalida(' . $data[$i]['id_salida'] . '); " title="Editar"> <i class="fa-solid fa-pen-to-square fa-lg"></i> 
             </button> <button class="btn btn-sm btn-danger px-3 py-2" type="button" onclick="btnEliminarSalida(' . $data[$i]['id_salida'] . ');" title="Eliminar"> <i class="fa-solid fa-trash fa-lg"></i> </button>
              <a class="btn btn-sm btn-warning px-3 py-2"href="' . base_url . 'Reportes/pdf7/' . $data[$i]['id_salida'] . '"
              target="_blank">        <i class="fa-solid fa-file-pdf"></i>    </a>
             </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Registrar o modificar salida
    public function registrar()
    {


        $id_salida = $_POST['id_salida'];
        $id_usuario = $_SESSION['id_usuario'];
        $actividad = $_POST['actividad'];
        $lugar = $_POST['lugar'];
        $id_chofer = $_POST['id_chofer']; // Si no se envía, asignar cadena vacía
        $transporte = $_POST['transporte'];
        $fecha_salida = $_POST['fecha_salida'];
        $hora_salida = $_POST['hora_salida'];
        $fecha_llegada = $_POST['fecha_llegada'];
        $hora_llegada = $_POST['hora_llegada'];

        if (empty($id_usuario) || empty($actividad) || empty($lugar) || empty($fecha_salida) || empty($hora_salida)) {
            $msg = array('msg' => 'Todos los campos obligatorios deben llenarse ☻', 'icono' => 'warning');
        } else {
            if ($id_salida == "") {
                // Nuevo registro
                $data = $this->model->registrarSalida($actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $fecha_llegada, $hora_llegada, $id_chofer, $id_usuario);
                //sacar el ultimo id salida registrado
        $id_salida = $this->model->MaxIdSalida();
                if ($data == "ok") {
             $msg = array('msg' => 'Salida  registrado ☻', 'icono' => 'success','id_salida'=>$id_salida['id_salida']);
                } else {
                    $msg = array('msg' => 'Error al registrar la salida ☻', 'icono' => 'error');
                }
            } else {
                // Modificar registro existente
                $data = $this->model->modificarSalida($actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $fecha_llegada, $hora_llegada, $id_chofer, $id_usuario, $id_salida);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Salida modificada con éxito ☻', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar la salida ☻', 'icono' => 'error');
                }
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Obtener datos de una salida para editar
    public function editar(int $id)
    {
        $data = $this->model->getSalidaEditar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Eliminar (desactivar) una salida
    public function eliminar(int $id)
    {
        $data = $this->model->accionSalida(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Salida eliminada con éxito ☻', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar la salida ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Reactivar una salida
    public function reingresar(int $id)
    {
        $data = $this->model->accionSalida(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Salida reactivada con éxito ☻', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al reactivar la salida ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    function inactivoVista()
    {
        
        $this->views->getView($this, "inactivos");
    }
    // Vista de salidas inactivas
    public function inactivos()
    {
        $id_user = $_SESSION['id_usuario'];

        // Administradores (ID 1 y 2)
        if ($id_user == 1 || $id_user == 2) {
            $data = $this->model->getSalidasadmin(0); // Todas las salidas

        } else {
            $data = $this->model->getSalidas($id_user, 0); // Solo sus salidas
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div class="d-flex gap-1">  </button> <button class="btn btn-sm btn-warning px-3 py-2" type="button" onclick="btnReactivarSalida(' . $data[$i]['id_salida'] . ');" title="Eliminar"> <i class="fa-solid fa-trash-arrow-up fa-lg"></i> </button> </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);


    }



}
?>