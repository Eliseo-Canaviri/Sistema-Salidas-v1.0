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
            $this->views->getView($this, "index", $data);
        } else {
            header('Location:' . base_url . 'Errors/permisos');
        }
    }

    // Listar salidas activas vía AJAX para DataTable
    public function listar()
    {
        $data = $this->model->getSalidas(1);

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div class="d-flex gap-1">
                <button class="btn btn-sm btn-primary" type="button" onclick="btnEditarSalida(' . $data[$i]['id_salida'] . ');" title="Editar">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-sm btn-danger" type="button" onclick="btnEliminarSalida(' . $data[$i]['id_salida'] . ');" title="Eliminar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Registrar o modificar salida
    public function registrar()
    {
        $id_salida      = $_POST['id_salida'];
        $id_funcionario = $_POST['id_funcionario'];
        $actividad      = $_POST['actividad'];
        $lugar          = $_POST['lugar'];
        $transporte     = $_POST['transporte'];
        $fecha_salida   = $_POST['fecha_salida'];
        $hora_salida    = $_POST['hora_salida'];
        $hora_llegada   = $_POST['hora_llegada'];

        if (empty($id_funcionario) || empty($actividad) || empty($lugar) || empty($fecha_salida) || empty($hora_salida) || empty($hora_llegada)) {
            $msg = array('msg' => 'Todos los campos obligatorios deben llenarse ☻', 'icono' => 'warning');
        } else {
            if ($id_salida == "") {
                // Nuevo registro
                $data = $this->model->registrarSalida($id_funcionario, $actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $hora_llegada);
                if ($data == "ok") {
                    $msg = array('msg' => 'Salida registrada con éxito ☻', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar la salida ☻', 'icono' => 'error');
                }
            } else {
                // Modificar registro existente
                $data = $this->model->modificarSalida($id_funcionario, $actividad, $lugar, $transporte, $fecha_salida, $hora_salida, $hora_llegada, $id_salida);
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
        $data = $this->model->getSalida($id);
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

    // Vista de salidas inactivas
    public function inactivos()
    {
        if (empty($_SESSION['activo'])) {
            header("location:" . base_url);
        }
        $data['salidas'] = $this->model->getSalidas(0);
        $this->views->getView($this, "inactivos", $data);
    }
}
?>
