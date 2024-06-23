<?php

class rolesModel extends Mysql
{
    private $conn;
    public $intIdRol;
    public $strRol;
    public $descripcionRol;
    public $intEstado;

    public function __construct()
    {
        parent::__construct();
        $this->conn = (new Conexion())->connect();
    }
     // Función para obtener un rol por su ID
     public function getRolById(int $id)
     {
         $this->intIdRol = $id;
         $sql = "SELECT * FROM rol WHERE rolId = $this->intIdRol";
         $request = $this->search($sql);
         return $request;
     }
    //funcion para consultar todos
    public function selectRoles()
    {
        $query = "SELECT * FROM rol WHERE rolId != 0 ORDER BY rolId ASC";
        $request = $this->searchAll($query);
        return $request;
    }
    //funcion para seleccionar un rol
    public function selectOneRol(int $id)
    {
        $this->intIdRol = $id;
        $sql = "SELECT * FROM rol WHERE rolId = $this->intIdRol";
        $request = $this->search($sql);
        return $request;
    }


    public function insertRol(string $rol, int $estado, string $descripcion)
    {
        $this->strRol = $rol;
        $this->descripcionRol = $descripcion;
        $this->intEstado = $estado;

        $query = "SELECT * FROM rol WHERE nombre = '{$this->strRol}'";
        $request = $this->searchAll($query);
        //validar si el rol ya existe
        if (!empty($request)) {
            return "exist";
        }

        $query_insert = "INSERT INTO rol (nombre, estado, descripcion) VALUES (?, ?, ?)";
        $arrData = array($this->strRol, $this->intEstado, $this->descripcionRol);
        $request_insert = $this->insert($query_insert, $arrData);
        //devolvemos el resultado  
        return $request_insert ?: false;
    }
    public function updateRol(int $id, string $rol, int $estado, string $descripcion)
{
    $this->intIdRol = $id;
    $this->descripcionRol = $descripcion;
    $this->intEstado = $estado;
    $this->strRol = $rol;

    // Verificar si el nombre del rol ha cambiado
    // Verificar si el nombre del rol ha cambiado
    if ($this->strRol !== $this->getRolById($this->intIdRol)['nombre']) {
        // Verificar si existe un rol con el mismo nombre y el mismo rolId
        $query = "SELECT * FROM rol WHERE nombre = ? AND rolId = ?";
        $arrData = array($this->strRol, $this->intIdRol); // 2 parámetros
        $request = $this->searchAll($query);
if (!empty($request)) {
            return 'exist';
        }
    }

    $query = "UPDATE rol SET nombre = ?, estado = ?, descripcion = ? WHERE rolId = ?";
    $arrData = array($this->strRol, $this->intEstado, $this->descripcionRol, $this->intIdRol);
    $request = $this->update($query, $arrData);

    return $request ?: false;
}
    public function deleteRol(int $idRol)
    {
        $this->intIdRol = $idRol;
        $query = "SELECT * FROM persona WHERE rolId = $idRol";
        $request = $this->searchAll($query);

        if (empty($request)) {
            $sql = "DELETE FROM rol WHERE rolId = $idRol";
            $request = $this->delete($sql);

            if ($request) {
                return "ok";
            } else {
                return "Error";
            }
        } else {
            return "exist";
        }
    }
}
?>