<?php

class rolesModel extends Mysql
{

    public $intIdRol;
    public $strRol;
    public $descripcionRol;
    public $intStatus;

    public function __construct()
    {
        parent::__construct();
    }

    //funcion para consultar todos
    public function selectRoles()
    {
        $query = "SELECT * FROM rol WHERE rol_id != 0 ORDER BY rol_id ASC";
        $request = $this->searchAll($query);
        return $request;
    }
    //funcion para seleccionar un rol
    public function selectOneRol(int $id)
    {
        $this->intIdRol = $id;
        $sql = "SELECT * FROM rol WHERE rol_id = $this->intIdRol";
        $request = $this->search($sql);
        return $request;
    }


    public function insertRol(string $rol, int $estatus, string $descripcion)
    {
        $retornar = "";
        $this->strRol = $rol;
        $this->descripcionRol = $descripcion;
        $this->intStatus = $estatus;

        $query = "SELECT * FROM rol WHERE nombre = '{$this->strRol}'";
        $request = $this->searchAll($query);

        if (empty($request)) {
            $query_insert = "INSERT INTO rol (nombre, estatus, descripcion) VALUES (?, ?, ?)";
            $arrData = array($this->strRol, $this->intStatus, $this->descripcionRol);
            $request_insert = $this->insert($query_insert, $arrData);
            $retornar = $request_insert;
        } else {
            $retornar = "exist";
        }

        return $retornar;
    }
    public function updateRol(int $id, string $rol, int $estatus, string $descripcion)
    {
        $this->intIdRol = $id;
        $this->descripcionRol = $descripcion;
        $this->intStatus = $estatus;
        $this->strRol = $rol;

        $query = "SELECT * FROM rol WHERE nombre = '{$this->strRol}' AND rol_id != $this->intIdRol";
        $request = $this->searchAll($query);

        if (empty($request)) {
            $query = "UPDATE rol SET nombre = ?, estatus = ?, descripcion = ? WHERE rol_id = $this->intIdRol";
            $arrData = array($this->strRol, $this->intStatus, $this->descripcionRol);
            $request = $this->update($query, $arrData);
        } else {
            return 'exist';
        }

        return $request;
    }
}
?>