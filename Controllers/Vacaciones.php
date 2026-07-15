<?php
class Vacaciones extends Controller
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
        $verificar = $this->model->verificarPermiso($id_user, 'Vacaciones');
        if (!empty($verificar) || $id_user == 1 || $id_user == 2) {
            //$data['funcionarios'] = $this->model->getFuncionarios();
            // $data['usuarios'] = $this->model->getUsuarios();
            $this->views->getView($this, "index");
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
            $data = $this->model->getVacaionesadmin(1); // Todas las salidas
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['estado'] = '<spam class="badge bg-warning">Solicitado</spam';
                $data[$i]['acciones'] = '<div class="d-flex gap-1">
            
             <button class="btn btn-sm btn-primary px-3 py-2" type="button" onclick="btnEditarVacaciones(' . $data[$i]['id_vacacion'] . '); " title="Editar"> <i class="fa-solid fa-pen-to-square fa-lg"></i> 
             </button> <button class="btn btn-sm btn-danger px-3 py-2" type="button" onclick="btnEliminarVacaciones(' . $data[$i]['id_vacacion'] . ');" title="Eliminar"> <i class="fa-solid fa-trash fa-lg"></i> </button>
 </button> <button  class="btn btn-sm btn-danger px-3 py-2" type="button" onclick="aprobar(' . $data[$i]['id_vacacion'] . ');" title="Eliminar">Aprobar <i class="fa-solid fa-trash fa-lg"></i> </button>

             
              <a class="btn btn-sm btn-warning px-3 py-2"href="' . base_url . 'Reportes/pdf7/' . $data[$i]['id_vacacion'] . '"
              target="_blank">        <i class="fa-solid fa-file-pdf"></i>    </a>
             </div>';
            }
        } else {
            $data = $this->model->getVacaciones($id_user, 1); // Solo sus salidas
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['estado'] = '<spam class="badge bg-warning">Solicitado</spam';
                $data[$i]['acciones'] = '<div class="d-flex gap-1">
            
             <button class="btn btn-sm btn-primary px-3 py-2" type="button" onclick="btnEditarVacaciones(' . $data[$i]['id_vacacion'] . '); " title="Editar"> <i class="fa-solid fa-pen-to-square fa-lg"></i> 
             </button> <button class="btn btn-sm btn-danger px-3 py-2" type="button" onclick="btnEliminarVacaciones(' . $data[$i]['id_vacacion'] . ');" title="Eliminar"> <i class="fa-solid fa-trash fa-lg"></i> </button>
              <a class="btn btn-sm btn-warning px-3 py-2"href="' . base_url . 'Vacaciones/pdfVacacion/' . $data[$i]['id_vacacion'] . '"
              target="_blank">        <i class="fa-solid fa-file-pdf"></i>    </a>
             </div>';
            }
        }



        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Registrar o modificar salida
    public function registrar()
    {


        $id_usuario = $_SESSION['id_usuario'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $dias = $_POST['dias'];
        $descripcion = $_POST['descripcion'];


        $id = $_POST['id'];
        if (empty($fecha_inicio) || empty($fecha_fin) || empty($dias)) {
            $msg = array('msg' => 'Todos los campos obligatorios deben llenarse ☻', 'icono' => 'warning');
        } else {
            if ($id == "") {
                // Nuevo registro
                $data = $this->model->registrar($id_usuario, $fecha_inicio, $fecha_fin, $dias, $descripcion);
                //sacar el ultimo id salida registrado
                $id_vaca = $this->model->MaxIdVacacion();
                if ($data == "ok") {
                    $msg = array('msg' => 'Vacion  registrado ☻', 'icono' => 'success', 'id_vacacion' => $id_vaca['id_vacacion']);
                } else {
                    $msg = array('msg' => 'Error al registrar la salida ☻', 'icono' => 'error');
                }
            } else {
                // Modificar registro existente
                $data = $this->model->modificar($id_usuario, $fecha_inicio, $fecha_fin, $dias, $descripcion, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Vacacion modificada con éxito ☻', 'icono' => 'success');
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
        $data = $this->model->getEditar($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Eliminar (desactivar) una salida
    public function eliminar(int $id)
    {
        $data = $this->model->accionVacaciones(0, $id);
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
        $data = $this->model->accionVacaciones(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Salida reactivada con éxito ☻', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al reactivar la salida ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    function aprobadosVista()
    {

        $this->views->getView($this, "aprobadosVista");
    }
    function inactivosVista()
    {

        $this->views->getView($this, "inactivosVista");
    }
    public function aprobados()
    {
        $id_user = $_SESSION['id_usuario'];

        // Administradores (ID 1 y 2)
        if ($id_user == 1 || $id_user == 2) {
            $data = $this->model->getVacaionesadmin(2); // Todas las salidas
        } else {
            $data = $this->model->getVacaciones($id_user, 2); // Solo sus salidas
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['estado'] = '<spam class="badge bg-success">Aprobado</spam';
            $data[$i]['acciones'] = '<div class="d-flex gap-1">  </button> <button class="btn btn-sm btn-warning px-3 py-2" type="button" onclick="btnReactivarSalida(' . $data[$i]['id_vacacion'] . ');" title="Eliminar"> <i class="fa-solid fa-trash-arrow-up fa-lg"></i> </button> </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);


    }

    public function aprobar(int $id)
    {
        //print_r($id);
     //   die();
        $data = $this->model->accionVacaciones(2, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Aprobado con éxito ☻', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function inactivos()
    {
        $id_user = $_SESSION['id_usuario'];

        // Administradores (ID 1 y 2)
        if ($id_user == 1 || $id_user == 2) {
            $data = $this->model->getVacaionesadmin(0); // Todas las salidas
        } else {
            $data = $this->model->getVacaciones($id_user, 0); // Solo sus salidas
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div class="d-flex gap-1">  </button> <button class="btn btn-sm btn-warning px-3 py-2" type="button" onclick="btnReactivarSalida(' . $data[$i]['id_vacacion'] . ');" title="Eliminar"> <i class="fa-solid fa-trash-arrow-up fa-lg"></i> </button> </div>';
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);


    }

}
?>