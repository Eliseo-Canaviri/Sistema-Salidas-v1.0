<?php
class Unidades extends Controller
{
  public function __construct()
  {
    session_start();

    parent::__construct();
  }

  public function index()
  {
    $id_user = $_SESSION['id_usuario'];
    $verificar = $this->model->verificarPermiso($id_user, 'unidades');
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

    $data = $this->model->getUnidades();

    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['estado'] == 1) {
        $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
        $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary" type="button"onclick="btnEditarUnidades(' . $data[$i]['id_unidad'] . ');"><i class="fas fa-edit"></i></button>
        <button class ="btn btn-danger" type="button"onclick="btnEliminarUnidades(' . $data[$i]['id_unidad'] . ');" ><i class="fas fa-trash-alt"></i></button>
      
        <div/>';

      } else {
        $data[$i]['estado'] = '<spam class="badge badge-danger">Inactivo</spam';
        $data[$i]['acciones'] = '<div>
       
        <button class ="btn btn-success" type="button"onclick="btnReingresarUnidades(' . $data[$i]['id_unidad'] . ');" ><i class="fas fa-undo"></i></button>
        <div/>';
      }



    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {


    $nombre = $_POST['nombre'];
    $id = $_POST['id'];


    if ( empty ($nombre)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');

    } else {
      if ($id == "") {
        $data = $this->model->registrarUnidad( $nombre);

        if ($data == "ok") {
          $msg = array('msg' => 'Unidad registrada ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al registrar ☻', 'icono' => 'error');
        }

      } else {
        $data = $this->model->modificarUnidad( $nombre, $id);
        if ($data == "modificado") {
          $msg = array('msg' => 'Unidad modificada con exito ☻', 'icono' => 'success');
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
    $data = $this->model->editarUnidad($id);
 
   // print_r($data);
  //  die();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {

    $data = $this->model->accionUnidad(0, $id);
    if ($data == 1) {
      $msg = array('msg' => 'Unidad eliminada con exito ☻', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar Unidad ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function reingresar(int $id)
  {
    $data = $this->model->accionUnidad(1, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al eliminar Unidad ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
    public function buscarUnidades()
    {
        if (isset($_GET['pro'])) {
            $data = $this->model->buscarUnidad($_GET['pro']);
            $datos = array();
            foreach ($data as $row) {
                $data['id_unidad'] = $row['id_unidad'];
                $data['label'] = $row['nombre'];
                $data['value'] = $row['nombre'];
                array_push($datos, $data);
            }
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        }
    }















}
?>