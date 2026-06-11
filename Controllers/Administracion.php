<?php

class Administracion extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function home()
    {
       $id_usuario=$_SESSION['id_usuario'];

        $data['salidas'] = $this->model->getDatos('salidas',$id_usuario);
   
   
        //$data['permisos'] = $this->model->getDatosCurso('permisos');
  
        $this->views->getView($this, "home", $data);

    }










}

?>