<?php 
class categoriasModel extends Mysql
{
    public $intIdcategoria;
    public $strCat;
    public $strDescripcion;
    public $intStatus;
    public $strPortada;


    public function __construct()
    {
     parent::__construct();
    }
    
    public function insertCategoria(string $nombreCat, string $descripcion, int $estatus, string $portada)
    {
        $retornar = "";
        $this->strCat = $nombreCat;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;
        $this->strPortada = $portada;

        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCat}'";
        $request = $this->searchAll($sql);

        if(empty($request)){
            $query_insert = "INSERT INTO categoria (nombre, descripcion, estadoId, portada) VALUES (?, ?, ?, ?)";
            $arrData = array($this->strCat, $this->strDescripcion, $this->intStatus, $this->strPortada);
            $request_insert = $this->insert($query_insert, $arrData);
            $retornar = $request_insert;
        }else{
            $retornar = "exist";
        }
        return $retornar;
    }
}










?>