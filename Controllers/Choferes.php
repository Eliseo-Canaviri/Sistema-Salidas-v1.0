<?php
class Choferes extends Controller
{
  public function __construct()
  {
    session_start();

    parent::__construct();
  }

  public function index()
  {
    $id_user = $_SESSION['id_usuario'];
    $verificar = $this->model->verificarPermiso($id_user, 'choferes');
    if (!empty ($verificar) || $id_user == 1) {
      $this->views->getView($this, "index");
    } else {
      header('Location:' . base_url . 'Errors/permisos');
    }


  }
  public function listar()
  {
    //vamos mandar por json a funciones.js
//print_r($this->model->getUsuarios());
//  die();

    $data = $this->model->getChoferes();

    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['estado'] == 1) {
        $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
        $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary" type="button"onclick="btnEditarChoferes(' . $data[$i]['id_chofer'] . ');"><i class="fas fa-edit"></i></button>
        <button class ="btn btn-danger" type="button"onclick="btnEliminarChoferes(' . $data[$i]['id_chofer'] . ');" ><i class="fas fa-trash-alt"></i></button>
      
        <div/>';

      } else {
        $data[$i]['estado'] = '<spam class="badge badge-danger">Inactivo</spam';
        $data[$i]['acciones'] = '<div>
       
        <button class ="btn btn-success" type="button"onclick="btnReingresarChoferes(' . $data[$i]['id_chofer'] . ');" ><i class="fas fa-undo"></i></button>
        <div/>';
      }



    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {


      $nlicencia = $_POST['nlicencia'];
      $nombres = $_POST['nombres'];
    $categoria = $_POST['categoria'];
    $id = $_POST['id'];


    if ( empty ($nombres)|| empty ($nlicencia) || empty ($categoria)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');

    } else {
      if ($id == "") {
        $data = $this->model->registrarChofer(  $nlicencia,$nombres, $categoria);

        if ($data == "ok") {
          $msg = array('msg' => 'Chofer registrado ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al registrar ☻', 'icono' => 'error');
        }

      } else {
        $data = $this->model->modificarChofer( $nlicencia,$nombres, $categoria, $id);
        if ($data == "modificado") {
          $msg = array('msg' => 'Chofer modificado con exito ☻', 'icono' => 'success');
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
    $data = $this->model->editarChofer($id);
 
   // print_r($data);
  //  die();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {

    $data = $this->model->accionChofer(0, $id);
    if ($data == 1) {
      $msg = array('msg' => 'Chofer eliminado con exito ☻', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar Chofer ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function reingresar(int $id)
  {
    $data = $this->model->accionChofer(1, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al reingresar Chofer ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function buscarChofer()
  {
    if (isset ($_GET['est'])) {
      $valor = $_GET['est'];
      $data = $this->model->buscarChofer($valor);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();    
    }
  }
















}
?>