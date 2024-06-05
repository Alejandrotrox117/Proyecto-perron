<?php 

class rolesModel extends Mysql
{
    public $strRol;
    public $strDescripcion;
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
    public function selectOneRol(int $id){
        $this -> intIdRol = $id;
        $sql = "SELECT * FROM rol WHERE rol_id = $this->intIdRol";
        $request = $this->search($sql);
        return $request;
    }


    public function insertRol(string $rol, int $estatus, string $descripcion)
    {
        $retornar = "";
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;

        $query = "SELECT * FROM rol WHERE nombre = '{$this->strRol}'";
        $request = $this->searchAll($query);

        if (empty($request)) {
            $query_insert = "INSERT INTO rol (nombre, estatus, descripcion) VALUES (?, ?, ?)";
            $arrData = array($this->strRol, $this->intStatus, $this->strDescripcion);
            $request_insert = $this->insert($query_insert, $arrData);
            $retornar = $request_insert;
        } else {
            $retornar = "exist";
        }

        return $retornar;
    }
    public function updateRol(int $id,string $rol,int $estatus,string $descripcion){
        $this -> intIdRol = $id;
        $this -> descripcion = $descripcion;
        $this -> estatus = $estatus;
        $this -> nombre= $rol;
        //indicamos si el nombre del rol es igual al que estamos actualizando o no con un id diferente
        $query = "SELECT * FROM roles WHERE nombre = '{$this -> nombre}' AND rol_id != $this -> intIdRol";
        $request =searchAll($query);

        if(empty($request)) {
            $query = "UPDATE roles SET nombre = ?, estatus = ?, descripcion = ? WHERE rol_id = $this -> intIdRol";
            $arrData = array($this -> nombre, $this -> estatus, $this -> descripcion);
            //llamamos a la funcion update de la clase mysql
            $request = $this -> update($query, $arrData);
            return $request;
        } else {
            return 'exist';
        }


    }

}

?>