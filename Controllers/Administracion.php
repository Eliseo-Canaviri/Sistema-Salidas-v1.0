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
       
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['ingresos'] = $this->model->getDatos('ingresos');
        $data['egresos'] = $this->model->getDatos('egresos');
        $data['permisos'] = $this->model->getDatosCurso('permisos');
        $data['anotes'] = $this->model->getDatosCurso('anotes');
        $this->views->getView($this, "home", $data);

    }










}

?>