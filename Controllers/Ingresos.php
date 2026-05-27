<?php
class Ingresos extends Controller
{
  public function __construct()
  {
    session_start();

    parent::__construct();
  }

  public function index()
  {
    $id_user = $_SESSION['id_usuario'];
    $verificar = $this->model->verificarPermiso($id_user, 'ingresos');
    if (!empty($verificar) || $id_user == 1) {
      $this->views->getView($this, "index");
    } else {
      header('Location:' . base_url . 'Errors/permisos');
    }


  }

  public function listar()
  {
$id_usuario=$_SESSION["id_usuario"];
    $data = $this->model->getIngresos($id_usuario);

    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['estado'] == 1) {
        $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
        $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary" type="button"onclick="btnEditarEstudiante(' . $data[$i]['id_ingreso'] . ');"><i class="fas fa-edit"></i></button>
        <button class ="btn btn-danger" type="button"onclick="btnEliminarEstudiante(' . $data[$i]['id_ingreso'] . ');" ><i class="fas fa-trash-alt"></i></button>
      
        <div/>';

      } else {
        $data[$i]['estado'] = '<spam class="badge badge-danger">Inactivo</spam';
        $data[$i]['acciones'] = '<div>
       
        <button class ="btn btn-success" type="button"onclick="btnReingresarEstudiante(' . $data[$i]['id_ingreso'] . ');" ><i class="fas fa-undo"></i></button>
        <div/>';
      }



    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {

    $ingreso = $_POST['ingreso'];
    $descripcion = $_POST['descripcion'];
    $id_ingreso = $_POST['id_ingreso'];
    $id_usuario=$_SESSION["id_usuario"];
    if (empty($ingreso) || empty($descripcion)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');

    } else {
      if ($id_ingreso == "") {
        $data = $this->model->RegistrarIngresos($ingreso, $descripcion, $id_usuario);

        if ($data == "ok") {
          $msg = array('msg' => 'Ingreso Registrado ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al Registrar ☻', 'icono' => 'error');
        }

      } else {
        $data = $this->model->modificarEstudiante($ci, $nombre, $id);
        if ($data == "modificado") {
          $msg = array('msg' => 'Estudiante modificado con exito ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al modificar ☻', 'icono' => 'error');
        }
      }

    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();

  }
  public function editar(int $id)
  {
    $data = $this->model->editarEstudiante($id);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {

    $data = $this->model->accionEstudiante(0, $id);
    if ($data == 1) {
      $msg = array('msg' => 'Estudiante eliminado con exito ☻', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar Estudiante ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function reingresar(int $id)
  {
    $data = $this->model->accionEstudiante(1, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al eliminar Estudiante ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function buscarEstudiante()
  {
    if (isset($_GET['est'])) {
      $valor = $_GET['est'];
      $data = $this->model->buscarEstudiante($valor);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
    }
  }
















}
?>