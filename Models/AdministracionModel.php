<?php
class AdministracionModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table WHERE estado = 1";
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
