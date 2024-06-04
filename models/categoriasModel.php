<?php 
class categoriasModel extends Mysql
{
    public $strCat;
    public $strDescripcion;
    public $intStatus;

    public function __construct()
    {
     parent::__construct();
    }
    
    public function insertCategoria(string $nombreCat, string $descripcion, int $estatus)
    {
        $retornar = "";
        $this->strCat = $nombreCat;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;

        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCat}'";
        $request = $this->searchAll($sql);

        if(empty($request)){
            $query_insert = "INSERT INTO categoria (nombre, descripcion, estadoId) VALUES (?, ?, ?)";
            $arrData = array($this->strCat, $this->strDescripcion,$this->intStatus);
            $request_insert = $this->insert($query_insert, $arrData);
            $retornar = $request_insert;
        }else{
            $retornar = "exist";
        }
        return $retornar;
    }
}










?>