<?php
class AdministracionModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getDatos(string $table,$id)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1 and id_usuario=$id  ";
        $data = $this->select($sql);
        return $data;
    }
    public function getDatosCurso(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table ";
        $data = $this->select($sql);
        return $data;
    }
}
