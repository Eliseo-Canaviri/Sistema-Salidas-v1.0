<?php

class ConfigAdmin extends Controller
{

	public function __construct()
	{
		session_start();
		/*if (empty($$_SESSION['activo'])) {
														 header("location".base_url);
													 }*/
		parent::__construct();

	}
	public function index()
	{
		$id_user = $_SESSION['id_usuario'];
		$verificar = $this->model->verificarPermiso($id_user, 'empresa');
		if (!empty($verificar) || $id_user == 1) {
			$data = $this->model->getEmpresa();
			$this->views->getView($this, "index", $data);
		} else {
			header('Location:' . base_url . 'Errors/permisos');
		}


	}
	public function modificar()
	{
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$mensaje = $_POST['mensaje'];
		$id = $_POST['id'];
		$data = $this->model->modificar($nombre, $telefono, $direccion, $mensaje, $id);
		if ($data = "ok") {
			$msg = "ok";
			// code...
		} else {
			$msg = "Error";
		}
		echo json_encode($msg, JSON_UNESCAPED_UNICODE);
		die();

	}






}


?>